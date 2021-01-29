# Запросы на вакансии

## Список запросов
CONTROLLER - `AdminInquirerController@list`

GET - `/admin/forms/inquirer/list`

`?sort_by=name&order_by=asc&email=gmail&perPage=123&name=Fa&phone=82`

params: 
```php 
return [
    'name'     => 'sometimes|string',
    'phone'    => 'sometimes|string',
    'email'    => 'sometimes|string',
    'resume'   => 'sometimes|boolean',
    'perPage'  => 'sometimes|numeric',
    'sort_by'  => [
        'sometimes',
            Rule::in(['name', 'phone', 'email', 'created_at'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

## Удалить запрос
CONTROLLER - `AdminInquirerController@delete`

DELETE - `/admin/forms/inquirer/{id}`


## Массовое удаление
CONTROLLER - `AdminInquirerController@massDeletion`

DELETE - `/admin/forms/inquirer/mass`

```php 
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:vacancy_inquirers,id'
];
```
