# Категории (для проодуктов и рецептов)

## Получить родителя рецептов\категорий
Controller - `AdminCategoryController@parent`

GET - '~/admin/category/parent?type=product'


```php
'type' => 'required|in:recipe,product'
```

## Список категорий
Controller - `AdminCategoryController@list`

GET - `~/admin/category/list`

Query: `?model=uncategorized|recipe|product|post`

Будет вернут массив с построенным деревом категорий



## Список фильров

Controller - `AdminCategoryController@listOfFilters`

GET - `~/admin/category/filters`

Query: `?model=uncategorized|recipe|product`
`&perPage={NUMBER}` <-- для пагинации дефолтное значение 10, его можно не проставлять. Что еще есть, смотри ниже:
`&sort_by=name&order_by=asc` 

Примечание: 
+ чтобы вернуть список фильтров с ПАРАМЕТРАМИ, нужно передать descendants = `true`

Params:
```php
return [
    'name'             => 'sometimes|string',
    'is_published'     => 'sometimes|boolean',
    'model'            => 'required|in:uncategorized,recipe,product',
    'perPage'          => 'sometimes|numeric',
    'descendants'      => 'sometimes|boolean',
    'orderByName'      => 'sometimes|in:asc,desc',
    'orderByPublished' => 'sometimes|in:asc,desc',
    'plucked'          => 'sometimes|boolean',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```


Будет вернут список фильтров (`"behavior_type": "filter"`) с родителем

## Список параметров

Controller - `AdminCategoryController@listOfParameters`

GET - `~/admin/category/parameters`

Query: `?model=uncategorized|recipe|product`
`&perPage={NUMBER}` <-- для пагинации дефолтное значение 10, его можно не проставлять. Что еще есть, смотри ниже:

Params:
```php
return [
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'filter'       => 'sometimes|integer|exists:categories,id',
    'model'        => 'required|in:uncategorized,recipe,product',
    'perPage'      => 'sometimes|numeric',
    'plucked'      => 'sometimes|boolean',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

Будет вернут список фильтров (`"behavior_type": "parameter"`) с родителем


## Создать категорию
Controller - `AdminCategoryController@create`

Permission -  `$user->can('manage category');`

POST - `~/admin/category`

Params: 
```php

        return [
            'models'           => 'bail|required|in:recipe,product,post',
            'name'             => 'required|required|max:250',
            'behavior_type'    => 'required|required|in:' . implode(',', $behaviors),
            'slug'             => 'sometimes|required|string|max:250',
            'image_url'        => 'sometimes|nullable|url',
            'meta_title'       => 'sometimes|nullable',
            'meta_description' => 'sometimes|nullable',
            'is_published'     => 'sometimes|required|boolean',
            'is_primary'       => 'sometimes|boolean',
            'parent_id'        => 'nullable|exists:categories,id',
        ];
```

Примечание: `behavior_type` - это показывает чем и является категория. Для Продуктов это: `category`, `filter` и `parameter`.
И еще, тут главное разделять что, для чего создается и где. На одной странице должны делаться категории для продуктов `product`, на другой для `recipe`.
Категории для `product` не могут лезть в `recipe`, и наоборот; 

Для постов `taxonomy`

Структура вложенности
```php
    public static array $BEHAVIOR_TYPE_RELATION = [
        'category' => [
            'category',
            'filter'
        ],
        'filter' => [
            'parameter'
        ],
        'parameter' => [],
    ];
```

## Обновить категоию
Controller - `AdminCategoryController@edit`

Permission -  `$user->can('manage category');`

PATCH - `~/admin/category/{category_id}`

Params
```php
return [
    'name'             => 'sometimes|required|max:250',
    'slug'             => 'sometimes|required|string|max:250',
    'is_published'     => 'sometimes|required|boolean',
    'is_primary'       => 'sometimes|boolean',
    'meta_title'       => 'sometimes|nullable',
    'meta_description' => 'sometimes|nullable',
];
```

## Переместить категорию в списке 
Примечание: только там где она создана, мы не можем менять родителя у категории. Только удалить и пересоздать

Controller - `AdminCategoryController@move`

Permission -  `$user->can('manage category');`

PUT  - `~/admin/category/{category_id}`

Params
```php
return [
    'case' => 'required|in:up,down'
];
```


## Сделать фильтр (категорию, он же 'behavior_type' => 'filter') основным
Controller - `AdminCategoryController@setPrimary`

Permission -  `$user->can('manage category');`

POST  - `~/admin/category/{category_id}`



## Опубликовать категорию  
Controller - `AdminCategoryController@publish`

Permission -  `$user->can('manage category');`

POST - `~/admin/category/{category_id}/publish`

Params
```php
return [
    'is_published' => 'required|boolean'
];
```

## Удалить категорию  
Controller - `AdminCategoryController@delete`

Permission -  `$user->can('manage category');`

DELETE - `~/admin/category/{category_id}`

Примечание: если у категории есть дети - они тоже удалятся

## Массовое удаление
Controller - `AdminCategoryController@delete`

Permission -  `$user->can('manage category');`

DELETE - `~/admin/category/mass`

Params:
```php
return [
   'ids' => 'required|array',
   'ids.*' => 'exists:categories,id'
];
```
Т.е. нужно просто передавать массив айдишников. Если какого-то айдишника со списка нет - падает ошибка


## Проверить слаг
Controller - `AdminCategoryController@checkSlug`

Permission - `$user->can('manage category');`

POST - `~/admin/category/slug`

Params: 
```php
return [
    'slug' => 'required|alpha_dash|max:250',
    'id' => 'sometimes|exists:categories,id'
];
```


