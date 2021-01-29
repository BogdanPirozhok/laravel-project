/* global response */
/* global axios */

import Pagination from "../components/Pagination";
import FilterComponent from "../components/FilterComponent";

export default {
    name: "CatalogComponent",
    components: {
        Pagination,
        FilterComponent
    },
    data() {
        return {
            catalogFilter: response.filters,
            choseFilter: response.data.selectedFilters.map(item => item.id),
            activeGroupFilter: response.data.selectedFilters.map(item => item.parent_id),
            items: response.data.query.data,
            base_path: response.base_path,
            point: null,
            pager: {
                reset: false,
                current: response.data.query.current_page,
                size: response.data.query.per_page,
                total: response.data.query.total
            }
        }
    },
    watch: {
        choseFilter: function () {
            if (this.pager.current) {
                this.pager.reset = true;
                this.pager.current = 0;
            }
            this.updateData();
        },
        'pager.current': function () {
            if (!this.pager.reset) {
                this.updateData();
            }
            this.pager.reset = false;
        }
    },
    computed: {
        shown: function() {
            return this.pager.current * this.pager.size + this.items.length;
        },
        pathFilter: function() {
            let data = {},
                path = [];

            this.catalogFilter.forEach(filter => {
                filter.descendants.forEach(descendant => {
                    if ( this.choseFilter.indexOf(descendant.id) !== -1 ) {
                        if (!data[filter.slug]) {
                            data[filter.slug] = [];
                        }
                        data[filter.slug].push(descendant.slug);
                    }
                });
            });

            for (let key in data) {
                path.push(key +'_'+ data[key].join('_'));
            }

            path = path.length ? '/'+ path.join('/') : '';

            return path;
        }
    },
    methods: {
        updateData: function () {
            let path = this.base_path + this.pathFilter,
                get = '?page='+ this.pager.current +'&json=true';

            window.history.replaceState(null, null, path);
            this.$root.isLoading.show = true;

            axios.get(path + get)
            .then(response => {
                const data = response.data;

                this.items = data.query.data;
                this.pager.current = data.query.current_page;
                this.pager.size = data.query.per_page;
                this.pager.total = data.query.total;
            })
            .catch(error => {
                if (error.response && error.response.status === 404) {
                    this.items = [];
                }
            })
            .finally(() => {
                setTimeout(() => {
                    this.$root.isLoading.show = false;
                }, 750)
            })
        }
    }
}
