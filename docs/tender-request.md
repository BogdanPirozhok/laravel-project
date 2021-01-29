# Запросы на тендер


## Список запросов на тендеры
Controller - `AdminTenderRequestController@list`

GET - `~//admin/forms/tender-request/list`


```php
return [
    'name'         => 'sometimes|string',
    'email'        => 'sometimes|string',
    'phone'        => 'sometimes|string',
    'company_name' => 'sometimes|string',
    'perPage'      => 'sometimes|numeric',
    'sort_by'      => [
        'sometimes',
        Rule::in(['name', 'email', 'phone', 'company_name'])
    ],
    'order_by'     => 'sometimes|in:asc,desc'
];
```


## Удалить запрос
Controller - `AdminTenderRequestController@delete`

DELETE - `~/admin/forms/tender-request/{id}`

## Массовое удаление
Controller - `AdminTenderRequestController@massDeletion`

DELETE - `~/admin/forms/tender-request/mass`

params:

```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:tender_requests,id'
];
```

