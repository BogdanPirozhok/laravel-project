# Рецепты



## Список рецептов
Controller `AdminRecipeController@list`

GET - `~/admin/recipe/list`
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


## Создание/Сохранение (да, один эндпоинт)
Controller - `AdminRecipeController@save`

POST - `~/admin/recipe/save`


Params: 
```php
return [
    'id'               => 'sometimes|numeric',
    'name'             => 'sometimes|nullable|string|min:2|max:250',
    'slug'             => 'sometimes|alpha_dash|max:250|unique:recipes,slug;',
    'image_url'        => 'sometimes|nullable|url',
    'is_published'     => 'sometimes|required|boolean',
    'meta_title'       => 'sometimes|nullable',
    'meta_description' => 'sometimes|nullable',

    'categories'       => 'sometimes|nullable|array',
    'complexity'       => 'sometimes|nullable|string|min:2|max:128',
    'cooking_time'     => 'sometimes|nullable|string|min:2|max:128',
    'servings'         => 'sometimes|nullable|string|min:2|max:128',

    'ingredients'      => 'sometimes|nullable|array',
    'body'             => 'sometimes|nullable|array',
];
```

Примечание:

Для создания нового рецепта - передаем id = 0, для редактирования, соответственно, id рецепта; 
делай на основе моего прототипа `resources/js/admin/components/EditorJS/RecipePrototype.vue` (`~/editor-recipe`)


## Сырой рецепт (без отрендериного html)
Controller - `AdminRecipeController@show`

GET - `~/admin/recipe/{recipe_id}`

## Сгенерить слаг
Controller - `AdminRecipeController@generateSlug`

POST - `~/admin/recipe/slug`

Params: 
```php
return [
    'slug' => 'required|alpha_dash|max:250',
    'id'   => 'sometimes|exists:categories,id'
];
```
Примечание: если собираемся делать рецепт - id не передаем.

## Список категорий которые можно привязать к рецепту
Controller - `AdminRecipeController@categories`

POST - `~/admin/recipe/categories-list`


## Удалить рецепт
Controller - `AdminRecipeController@delete`

DELETE - `~/admin/recipe/{recipe_id}`


## Массовое удаление рецептов
Controller - `AdminRecipeController@massDeletion`

DELETE - `~/admin/recipe/`

```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:recipes,id'
];
```
