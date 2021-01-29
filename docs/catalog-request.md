# Запрос каталога


## Список
controller - `AdminCatalogRequestController@list`

GET - `~/admin/forms/catalog-request/list`

`?perPage=50&name=bodya&email=bodya@gmail.com&phone=911&company_name=itde&sort_by=name&order_by=desc`

params:

```php 
return [
    'name' => 'sometimes|string',
    'email' => 'sometimes|string',
    'phone' => 'sometimes|string',
    'company_name' => 'sometimes|string',
    'perPage' => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'email', 'phone', 'company_name', 'data_processing'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```


## Отдельный запрос
controller - `AdminCatalogRequestController@show`

GET - `~/admin/forms/catalog-request/{id}`


## Удалить запрос
controller - `AdminCatalogRequestController@delete`

DELETE - `~/admin/forms/catalog-request/{id}`

## Массовое удаление
controller - `AdminCatalogRequestController@massDelete`

DELETE - `~/admin/forms/catalog-request/mass`
```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:catalog_requests,id'
];
```
