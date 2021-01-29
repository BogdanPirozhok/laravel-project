# Тендеры\категории

## Список
Controller - `AdminTenderController@list`

GET - `~/admin/tender/list`

params:
```php
return [
    'type'         => [
        'required',
        Rule::in([Tender::PURCHASE, Tender::TENDER]),
    ],
    'perPage'      => 'sometimes|numeric',
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'sort_by'      => [
        'sometimes',
        Rule::in(['name', 'is_published', 'unit', 'volume'])
    ],
    'order_by'     => 'sometimes|in:asc,desc'
];
```
По deadline не сортируем.


`type=purchase` или  `type=tender` 

## Сохранить\Обновить

Controller - `AdminTenderController@save`

POST - `~/admin/tender/save`

Примечание:

`type=purchase` или  `type=tender` 

Там где `required_if` используется - это для тендеров. и там просто передавать файл нужно. 
5 мегабайт ограничение.  

```php
return [
    'id'           => 'required|numeric',
    'type'         => [
        'required',
        Rule::in([Tender::PURCHASE, Tender::TENDER]),
    ],
    'name'         => 'required|string|max:250',
    'unit'         => 'required|string|max:250',
    'volume'       => 'required|string|max:250',
    'description'  => 'required|string',
    'is_published' => 'sometimes|required|boolean',
    'deadline'     => 'required_if:type,' . Tender::TENDER . '|string',
    'job_file'     => 'required_if:type,' . Tender::TENDER . '|file|max:5000',
    'work_file'    => 'required_if:type,' . Tender::TENDER . '|file|max:5000',
];
```
## Осмотреть

Controller - `AdminTenderController@view`

GET - `~/admin/tender/{tender_id}`

## Опубликовать

Controller - `AdminTenderController@publish`

POST - `~/admin/tender/{tender_id}`



## Удалить
Controller - `AdminTenderController@delete`

DELETE - `~/admin/tender/{tender_id}`

## Массовое удаление
Controller - `AdminTenderController@massDeletion`

DELETE - `~/admin/tender/`

params:
```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:tenders,id'
];
```
