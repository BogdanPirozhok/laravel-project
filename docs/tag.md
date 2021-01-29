# Теги (для продуктов)

## Список тегов
Controller - `AdminTagController@list`

GET - `~/admin/tag/list`

Query: `?model=recipe|product`
`?perPage={NUMBER}&sort_by=name&order_by=asc` <-- 5 дефолтное
`sort_by` -- только по `name` или `is_published`
`order_by` -- дефолтное `asc`

Parameters: 
```php
return [
    'model'        => 'required|in:product,recipe',
    'name'         => 'sometimes|string',
    'perPage'      => 'sometimes|numeric',
    'is_published' => 'sometimes|boolean',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

Будет вернут массив с тегами.

## Создание Тега
Controller - `AdminTagController@create`

Permission: `$user->can('manage category');`

POST - `~/admin/tag`

PARAM:
```php
return [
    'name' => 'required|string|max:250',
    'image_url' => 'required|url',
    'is_published' => 'sometimes|required|boolean'
];
```

## Редактирование Тега
Controller - `AdminTagController@update`

Permission: `$user->can('manage category');`

PATCH - `~/admin/tag/{tag_id}`

PARAM:
```php
return [
    'name' => 'required|string|max:250',
    'image_url' => 'required|url',
    'is_published' => 'sometimes|required|boolean'
];
```

## Публикация Тега
Controller - `AdminTagController@update`

Permission: `$user->can('manage category');`

PATCH - `~/admin/tag/{tag_id}/publish`
```php
return [
    'is_published' => 'required|boolean'
];
```


## Удаление Тега
Controller - `AdminTagController@delete`

Permission: `$user->can('manage category');`

DELETE - `~/admin/tag/{tag_id}`


