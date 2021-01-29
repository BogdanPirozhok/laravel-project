# Упаковки (для продуктов)

## Список упаковок
Controller - `AdminProductPackageController@list`

GET - `~/admin/package/list`
Query;
`?perPage={NUMBER}&sort_by=name&order_by=asc` <-- 5 дефолтное
`sort_by` -- только по `name` или `is_published`
`order_by` -- дефолтное `asc`


Params:
```php
return [
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'perPage'      => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

## Создание упаковки
Controller - `AdminProductPackageController@create`

Permission - `$user->can('manage category');`

GET - `~/admin/package`


Params: 
```php
return [
  'name' => 'required|string|max:250',
  'image_url' => 'required|url',
  'is_published' => 'sometimes|required|boolean'
];
```


## Обновление упаковки
Controller - `AdminProductPackageController@update`

Permission - `$user->can('manage category');`

PATCH - `~/admin/package/{package_id}`


Params: 
```php
return [
  'name' => 'required|string|max:250',
  'image_url' => 'required|url',
  'is_published' => 'sometimes|required|boolean'
];
```

## Публикация упаковки
Controller - `AdminProductPackageController@publish`

Permission - `$user->can('manage category');`

PATCH - `~/admin/package/{package_id}/publish`


Params: 
```php
return [
    'is_published' => 'required|boolean'
];
```

## Удаление упаковки
Controller - `AdminProductPackageController@delete`

Permission - `$user->can('manage category');`

DELETE - `~/admin/package/{package_id}`
