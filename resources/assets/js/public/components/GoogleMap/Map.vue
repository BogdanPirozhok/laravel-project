<template>
    <div class="map__container">
        <div class="map__head-wrapper">
            <div class="map__head">
                <autocomplete
                    ref="autocomplete"
                    class="map__search"
                    :search="addressSearch"
                    placeholder="Поиск по адресу"
                    aria-label="Поиск по адресу"
                    :get-result-value="resultSearch"
                    :debounce-time="250"
                    @submit="submitSearch"
                >
                    <template
                        #default="{
                            // eslint-disable-next-line vue/no-unused-vars
                            rootProps,
                            // eslint-disable-next-line vue/no-unused-vars
                            inputProps,
                            // eslint-disable-next-line vue/no-unused-vars
                            inputListeners,
                            // eslint-disable-next-line vue/no-unused-vars
                            resultListProps,
                            // eslint-disable-next-line vue/no-unused-vars
                            resultListListeners,
                            // eslint-disable-next-line vue/no-unused-vars
                            results,
                            // eslint-disable-next-line vue/no-unused-vars
                            resultProps
                        }"
                    >
                        <div v-bind="rootProps">
                            <custom-input
                                v-bind="inputProps"
                                v-on="inputListeners"
                            />

                            <span
                                v-if="value.length > 0"
                                class="clear-auto-input"
                                @click="clearInput"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="50"
                                    height="50"
                                    viewBox="0 0 50 50"
                                >
                                    <path
                                        fill="#D8D8D8"
                                        fill-rule="evenodd"
                                        stroke="#979797"
                                        d="M31.718 16.575L25 23.293l-6.718-6.718a.5.5 0 0 0-.707.707L24.293 24l-6.718 6.718a.5.5 0 0 0 .707.707L25 24.707l6.718 6.718a.5.5 0 0 0 .707-.707L25.707 24l6.718-6.718a.5.5 0 0 0-.707-.707z"
                                    />
                                </svg>
                            </span>

                            <ul
                                v-if="noResults"
                                class="autocomplete-result-list"
                                style="position: absolute; z-index: 1; width: 100%; top: 100%;"
                            >
                                <li class="autocomplete-result">
                                    No results found
                                </li>
                            </ul>
                            <ul
                                v-bind="resultListProps"
                                v-on="resultListListeners"
                            >
                                <li
                                    v-for="(result, index) in results"
                                    :key="resultProps[index].id"
                                    v-bind="resultProps[index]"
                                >
                                    {{ result.address }}
                                </li>
                            </ul>
                        </div>
                    </template>
                </autocomplete>
                <div
                    v-click-outside="hideFilter"
                    class="map__box"
                >
                    <span class="map__title">Показать на карте</span>

                    <div class="select-map">
                        <div
                            class="select-map__btn"
                            :class="{active: select}"
                            @click="select = !select"
                        >
                            <span class="select-map__title">{{ selectedType.name }}</span>

                            <svg
                                width="18"
                                height="11"
                                viewBox="0 0 18 11"
                                fill="none"
                            >
                                <path
                                    d="M1 1L9 9L17 1"
                                    stroke="#1C2545"
                                    stroke-width="2"
                                />
                            </svg>
                        </div>

                        <template>
                            <transition name="select">
                                <ul
                                    v-if="select"
                                    class="select-map__show"
                                >
                                    <li
                                        class="select-map__text"
                                        :class="{active: filter.type.selected === null}"
                                        @click="filter.type.selected = null"
                                    >
                                        Все
                                    </li>
                                    <li
                                        v-for="item in filter.type.list"
                                        :key="item.type"
                                        class="select-map__text"
                                        :class="{active: filter.type.selected === item.type}"
                                        @click="filter.type.selected = item.type"
                                    >
                                        {{ item.name }}
                                    </li>
                                </ul>
                            </transition>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div
            ref="googleMap"
            class="google-map"
        />
    </div>
</template>

<script>
import Vue from "vue";
import vClickOutside from 'v-click-outside'

import axios from 'axios';
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'

import find from 'lodash/find';
import CustomInput from "./CustomInput";

Vue.use(vClickOutside);

// если объявлять в датке - то оно нормально не работает. Вообще. По этому в глобальном будет
let map;
let markers = [];

export default {
    components: {
        CustomInput,
        Autocomplete
    },
    data: function () {
        return {
            // eslint-disable-next-line no-undef
            // bounds: new google.maps.LatLngBounds(), // Авто масштабирование карты
            value: '',
            select: false,
            currentBounds: {
                lat0: null,
                lng0: null,
                lat1: null,
                lng1: null,
            },
            baseIcon: {
                url: this._asset('/library/img/rybka.png'),
                // ресайз картинки
                scaledSize: new window.google.maps.Size(32, 34),
                // отцентровать иконку маркера по середине иконки. у нас тут иконка 112x112 и мы ее сжимаем то 64х64
                anchor: new window.google.maps.Point(32, 32),
            },
            currentZoom: null,
            mapOptions: {
                center: {lat: 55.79093484254937, lng: 49.12193056124628},
                zoomControl: true,
                zoom: 3,
                gestureHandling: 'cooperative'
            },
            locations: null,
            filter: {
                type: {
                    selected: null,
                    list: [
                        {
                            type: 1,
                            name: 'Retail'
                        },
                        {
                            type: 2,
                            name: 'Destrib'
                        },
                        {
                            type: 3,
                            name: 'Networks'
                        }
                    ]
                },
                store_uid: {
                    selected: null,
                    list: [],
                }

            },
            results: [],
        }
    },
    computed: {
        noResults() {
            return this.value && this.results.length === 0
        },
        selectedType() {
            let item = this.filter.type.list.find(item => item.type === this.filter.type.selected);

            return item ? item : {
                type: null,
                name: 'Все'
            };
        }
    },
    watch: {
        'filter.type.selected'() {
            this.select = false;
            this.fetchMarkers();
        }
    },
    async mounted() {
        this.getNetworks().then(() => {
            this.getPoints().then(() => {
                this.initMap()
            })
        })
    },
    methods: {
        hideFilter() {
            this.select = false;
        },
        resultSearch(item) {
            return item.address;
        },
        submitSearch(data) {
            let marker = find(window.markers, {id: data.id});
            this.openMarker(marker);
        },
        initMap() {

            // eslint-disable-next-line no-unused-vars
            map = window.map = new window.google.maps.Map(this.$refs.googleMap, {
                ...this.mapOptions
            })

            this.setMarkers();

            // КЛАСТЕРИЗАЦИЯ МАРКЕРОВ (оч. плохая производительность при 5к+ маркеров)
            // eslint-disable-next-line no-unused-vars
            let markerCluster = new window.MarkerClusterer(map, markers, {imagePath: 'https://unpkg.com/@googlemaps/markerclustererplus@1.0.3/images/m'})

            // обновляются точки карты. правая верхняя и левая нижняя точки отображения карты
            map.addListener('bounds_changed', () => {
                let lat0 = map.getBounds().getNorthEast().lat();
                let lng0 = map.getBounds().getNorthEast().lng();
                let lat1 = map.getBounds().getSouthWest().lat();
                let lng1 = map.getBounds().getSouthWest().lng();
                this.currentBounds = {lat0, lng0, lat1, lng1};
                this.currentZoom = map.getZoom();
            })
        },
        setMarkers() {
            // инфо-окно
            // https://developers.google.com/maps/documentation/javascript/infowindows
            window.infowindow = new window.google.maps.InfoWindow({
                maxWidth: 350,
            });

            // eslint-disable-next-line no-unused-vars
            markers = window.markers = this.locations.map((location, index) => {

                // создаем объект маркера
                let marker = this.addMarker(location)

                // листенер чтобы при клике открывать инфо-окно на карте над маркером.
                // https://developers.google.com/maps/documentation/javascript/events
                marker.addListener('click', async () => {

                    await this.openMarker(marker)

                })

                return marker;
            });
        },
        async openMarker(marker) {
            let content = await this.getPointContent(marker.id)
            // сюда спокойно можно скармливать строку c html
            window.infowindow.setContent(content.info);
            window.infowindow.open(map, marker)
            // переместиться на маркер по клику
            map.panTo(marker.getPosition())
            // и увеличить зум
            map.setZoom(16);
        },
        addMarker(location) {
            let marker = new window.google.maps.Marker({
                id: location.id,
                position: {lat: location.lat, lng: location.lng},
                map: map,
                icon: {...this.baseIcon, url: location.icon ?? this.baseIcon.url},
                // label: location.name_point,
            })
            markers.push(marker)
            return marker;
        },
        setMapOnAll(map) {
            markers.forEach(el => {
                el.setMap(map)
            })
        },
        deleteMarkers() {
            this.setMapOnAll(null);
            markers = [];
        },
        async getPoints() {
            let res = await axios.get('/map/points/list', {
                params: {
                    type: this.filter.type.selected,
                    store_uid: this.filter.store_uid.selected
                }
            });
            this.locations = res.data.data;
        },
        // Это нужно будет получить пропсом от сервера
        async getNetworks() {
            let res = await axios.get('/map/networks')

            this.filter.store_uid.list = res.data;
        },
        async fetchMarkers() {
            await this.getPoints();

            this.deleteMarkers()

            this.setMarkers();
        },
        async addressSearch(input) {
            this.value = input;
            if (input.length < 1) {
                console.log(this.results, 'before')
                this.reslut = [];
                console.log(this.results, 'after')
                return []
            }
            let res = await axios.get('/map/search', {
                params: {
                    address: input
                }
            })

            this.results = res.data.data;
            return res.data.data
        },
        clearInput() {
          console.log('clearing input!!');
            this.$refs.autocomplete.value = ''
            this.value = '';
        },
        async getPointContent(id) {
            let res = await axios.get('/map/points/' + id);

            return res.data.data
        }
    }
}
</script>

<style lang="scss">
.clear-auto-input {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translate(-50%, -38%);
    cursor: pointer;

}

.map {
    &__container {
        position: relative;
    }

    &__head {
        display: flex;
        height: 4.75rem;
        border-radius: 8px;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.02), 0 4px 4px 0 rgba(0, 0, 0, 0.02), 0 8px 8px 0 rgba(0, 0, 0, 0.02), 0 16px 16px 0 rgba(0, 0, 0, 0.02), 0 32px 32px 0 rgba(0, 0, 0, 0.02), 0 64px 64px 0 rgba(0, 0, 0, 0.02);
    }

    &__head-wrapper {
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 56px;
        max-width: 1280px;
        width: 100%;
        padding: 0 30px;
        z-index: 1;
    }

    &__box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        max-width: 300px;
        width: 100%;
        min-width: 200px;
        padding: 0 1.5rem;
        border-left: 1px solid #F0F0F0;
        background: #fff;
        border-radius: 0 8px 8px 0;
        position: relative;
    }

    &__search {
        max-width: 920px;
        width: 100%;

        .autocomplete {
            height: 100%;

            &[data-expanded="true"] input {
                border-radius: 8px 0 0 0;
            }
        }

        .autocomplete-input {
            background: #fff;
            border: unset;
            padding: 0 3rem;
            border-radius: 8px 0 0 8px;
            font-size: 1.25rem;
            height: 100%;
        }

        .autocomplete-result {
            background: unset;
            padding: 1.25rem 3rem;
            font-size: 1.25rem;
            cursor: pointer;
        }
    }

    &__title {
        font-size: 1rem;
        color: #8D92A2;
    }
}

.google-map {
    height: 100vh;
    max-height: 720px;
}

.select-map {
    position: relative;

    &__btn {
        display: flex;
        align-items: center;
        cursor: pointer;

        &.active svg {
            transform: scale(1, -1);
        }

        svg {
            width: 16px;
            margin-left: auto;
        }
    }

    &__title {
        font-size: 1.25rem;
        cursor: pointer;
        width: calc(100% - 24px);
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    &__show {
        display: flex;
        flex-direction: column;
        padding-top: .875rem;
        position: absolute;
        top: 100%;
        left: -1.5rem;
        width: calc(100% + 3rem);
        background: #fff;
        max-height: calc(296px + .875rem);
        overflow-x: hidden;
        overflow-y: auto;
        border-radius: 0 0 8px 8px;
    }

    &__text {
        padding: 1.25rem 2.16rem 1.25rem 1.5rem;
        font-size: 1.25rem;
        cursor: pointer;
        position: relative;

        &.active:after {
            opacity: 1;
            transform: translateY(-50%) scale(1);
        }

        &:after {
            content: "";
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%) scale(.5);
            width: 1rem;
            height: 1rem;
            background: url(./../../../../img/public/select-map__mark.svg) center/contain no-repeat;
            margin-right: .625rem;
            opacity: 0;
        }
    }
}

@media screen and (max-width: 991px) {
    .map {
        &__head-wrapper {
            transform: translateX(0);
            left: 0;
            margin-top: 12px;
            width: calc(100% - 50px);
        }

        &__search {
            .autocomplete-input {
                padding: 0 21px;
            }

            .autocomplete-result {
                padding: 1.25rem 21px;
            }
        }
    }
}

@media screen and (max-width: 580px) {
    .map {
        &__head {
            flex-direction: column-reverse;
            height: auto;
        }

        &__box {
            border-radius: 8px 8px 0 0;
            padding: 6px 1.5rem;
            border-left: unset;
            border-bottom: 1px solid #F0F0F0;
            max-width: 100%;
        }

        &__search {
            height: 50px;

            .autocomplete {
                &[data-expanded="true"] input {
                    border-radius: 0;
                }
            }

            .autocomplete-input {
                border-radius: 0 0 8px 8px;
            }
        }
    }
}
</style>
