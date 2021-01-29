# Продукты

## Список продуктов
Controller - `AdminProductController@list`

GET - `~/admin/products/list`
Query;
`?perPage=10&sort_by=name&order_by=asc&parameter=7` <-- 10 дефолтное

`sort_by` -- только по `name` или `is_published`

`order_by` -- дефолтное `asc`

`parameter` -- id категории, по которой нужно найти. (сортировки нет)

Можно сортировать только по одному значению за раз

Подобные query ниже

Parameters:
```php
return [
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'parameter'    => 'sometimes|integer|exists:categories,id',
    'perPage'      => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'is_published'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

## Создать\отредактировать продукт

Controller - `AdminProductController@save`

POST - `~/admin/products/save`


PARAMS:
```php
return [
    // general tab 6 input
    'id'                   => 'sometimes|numeric',
    'name'                 => 'required|string|max:250',
    'slug'                 => 'sometimes|alpha_dash|max:250',
    'is_published'         => 'sometimes|required|boolean',
    'meta_title'           => 'sometimes|nullable',
    'meta_description'     => 'sometimes|nullable',
    'tags'                 => 'sometimes|nullable|array',
    // categories tab 1 input
    'categories'           => 'sometimes|array',
    'categories.*'         => 'exists:categories,id',
    // specs tab 1 input
    'specs'                => 'required|array',
    'package'              => 'sometimes|nullable|numeric',
    // raw material tab 4 inputs
    'material_title'       => 'sometimes|nullable|string',
    'material_sub_title'   => 'sometimes|nullable|string',
    'material_description' => 'sometimes|nullable|string',
    'material_image_url'   => 'sometimes|nullable|url',
    // other tab 3 inputs
    'is_popular'           => 'sometimes|boolean',
    'similar_products'     => 'sometimes|nullable|array',
    'similar_recipes'      => 'sometimes|nullable|array'
];
```

Примечание:
`specs` - это данные editorjs. 

`categories`, `similar_products`, `similar_recipes` - содержат в себе массив с айдишниками

Чтобы опубликовать\распубликовать продукт прям из редактора - нужно сделать соответствующую кнопку которая 
будет менять значение `is_published` и вызывает метод сохранения.

## Удалить продукт
Controller - `AdminProductController@delete`

DELETE - `~/admin/products/{product_id}`

## Массовое удаление продукта
Controller - `AdminProductController@massDeletion`

DELETE - `~/admin/products/mass`

params:
```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:products,id'
];
```

## Поиск продукта\рецепта
Controller - `AdminProductController@findSimilar`

POST - `~/admin/products/similar`

PARAMS
```php
return [
    'name'     => 'required|string',
    'params'   => 'sometimes|array',
    'params.*' => 'exists:categories,id',
    'case'     => 'required|in:product,recipe',
];


```

## Список категорий (параметров) для продуктов/рецептов(которые можно привязать)
Смотри `category.md`

## Список групп (фильтров) для продуктов рецептов 
Смотри `category.md`

## Список тегов
Controller - `AdminProductController@tags`

GET - `~/admin/products/tags`
