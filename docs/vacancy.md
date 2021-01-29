# Вакансии

## Список
Controller - `AdminVacancyController@list`

GET - `~/admin/vacancy/list`
`?sort_by=city&order_by=asc&perPage=3`



params:
```php
return [
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'perPage'      => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published', 'city'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

## Сохранить\Обновить вакансию
Controller - `AdminVacancyController@list`

POST - `~/admin/vacancy`

Примечание: 
Прокидываем `id = 0` если нужно создать новую вакансию
```php
return [
    'id'              => 'sometimes|numeric',
    'name'            => 'required|string|max:250',
    'city'            => 'required|string|max:250',
    'payment'         => 'required|string|max:250',
    'employment_type' => 'required|string|max:250',
    'is_published'    => 'sometimes|required|boolean',
    'body'            => 'required|array',
];
```


## Опубликовать\распубликовать вакансию
Controller - `AdminVacancyController@publish`

POST - `~/admin/vacancy/{vacancy_id}`

```php
return [
    'is_published' => 'required|boolean'
];
```

## Массовая публикация\распубликация
Controller - `AdminVacancyController@massPublish`

POST - `~/admin/vacancy/{vacancy_id}`


params: 
```php
return [
    'ids' => 'required|array',
    'ids.*' => 'exists:vacancies,id',
    'is_published' => 'required|boolean'
];
```


## Удалить вакансию
Controller - `AdminVacancyController@delete`

DELETE - `~/admin/vacancy/{vacancy_id}`


## Массовое удаление вакансий 
Controller - `AdminVacancyController@massDelete`

DELETE - `~/admin/vacancy/mass`

params:
```php
return [
    'ids' => 'required|array',
    'ids.*' => 'exists:categories,id'
];
```
