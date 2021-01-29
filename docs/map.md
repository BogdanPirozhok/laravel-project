# Карта

## Админка

## Сети магазинов

### Список магазинов
Controller - `AdminMapController@storeNetworkList`

GET - `~/admin/map/networks/list`
`?perPage=10&page=1&name=Qui&sort_by=name&order_by=asc`
Сортировка только по имени есть.

params: 
```php
return [
    'perPage'  => 'sometimes|numeric',
    'sort_by'  => [
        'sometimes',
        Rule::in(['name'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

### Сохранить\обновить магазинг
Controller - `AdminMapController@saveStoreNetwork`

POST - `~/admin/map/networks/save`


params: 
```php 
return [
    'id'           => 'required|numeric',
    'title'        => 'required|string|max:250',
    'description'  => 'required|string',
    'logo_image'   => 'required|mimes:png|max:350',
    'mark_image'   => 'required|mimes:png|max:350',
    'external_url' => 'nullable|string',
    'store_uid'    => 'string|unique:store_networks,store_uid,' . $this->id
];
```

### Посмотреть сеть
Controller - `AdminMapController@viewStoreNetwork`

GET - `~/admin/map/networks/{id}`

### Удалить сеть
Controller - `AdminMapController@deleteStoreNetwork`

DELETE - `~/admin/map/networks/{id}`

### Массовое удаление сетей 
Controller - `AdminMapController@massDeleteStoreNetwork`

DELETE - `~/admin/map/networks/mass`


```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:store_networks,id'
];
```



### Заливка CSV
Controller - `AdminMapController@storeCsv`

POST - `~/admin/map/points/store`
```
const RETAIL = 1;
const DISTRIBUTOR = 2;
const NETWORK = 3;
```

```php
return [
    'type' => ['required', Rule::in(Point::RETAIL, Point::DISTRIBUTOR, Point::NETWORK)],
    'csv' => 'required|mimes:csv,txt|max:50000'
];
```

## Публичная часть 

### Получить список точек
Controller - `PublicSite\MapController@points`

GET - `~/map/points/list`

params:

```php
return [
    'type' => ['sometimes', 'nullable', Rule::in([Point::RETAIL, Point::DISTRIBUTOR, Point::NETWORK])],
    'store_uid' => ['sometimes', 'nullable', Rule::exists('store_networks')->where(function($query) {
        return $query->where('store_uid', $this->store_uid);
    })]
];
```

### Получить информацию об определенной точке

Controller - `PublicSite\MapController@viewPoint`

GET - `~/map/points/{point_id}`


### Получить список Сетей магазинов (эта информация потом будет передавать в пропс компонента через сервер)
Controller - `PublicSite\MapController@networks`

GET - `~/map/networks`

### Поиск адресов
Controller - `PublicSite\MapController@search`

GET - `~/map/search`

Params: 
    Передавай address = 'нужный адрес'


