# Запросы на "Контакт"

## Список запросов 
Controller 'AdminContactRequestController@list'

GET - `~/admin/forms/contact-request/list`

`?name=Guido&phone=38099&email=@gmail.com&sort_by=name&order_by=asc`


```php 
return [
    'name'     => 'sometimes|string',
    'email'    => 'sometimes|string',
    'phone'    => 'sometimes|string',
    'perPage'  => 'sometimes|numeric',
    'data_processing' => 'sometimes|boolean',
    'sort_by'  => [
        'sometimes',
        Rule::in(['name', 'is_published', 'email', 'phone', 'data_processing'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```



## Удалить запрос
Controller 'AdminContactRequestController@delete'

DELETE - `~/admin/forms/contact-request/{id}`


## Удалить запрос
Controller 'AdminContactRequestController@massDelete'

DELETE - `~/admin/forms/contact-request/mass`

```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:contact_requests,id'
];
```


