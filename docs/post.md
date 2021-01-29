# Посты

## Список постов
Controller - `AdminPostController@list`


GET - `~/admin/news/list`
`?sort_by=name&order_by=desc&name=after`

params
```php
return [
    'name'         => 'sometimes|string',
    'is_published' => 'sometimes|boolean',
    'is_featured'  => 'sometimes|boolean',
    'perPage'      => 'sometimes|numeric',
    'sort_by'      => [
        'sometimes',
        Rule::in(['name', 'is_published', 'is_featured'])
    ],
    'order_by'     => 'sometimes|in:asc,desc'
];
```

## Один пост
Controller - `AdminPostController@show`


GET  - `~/admin/news/{post_id}`



## Сохранить\обновить пост
Controller - `AdminPostController@save`

POST - `~/admin/news/save`

Примечание: `taxonomy` у нас нужно передавать только одну. Список тут `~/admin/category/list?model=post`

params
```php
return [
    'id'           => 'required|numeric',
    'name'         => 'required|string|max:250',
    'is_published' => 'sometimes|required|boolean',
    'body'         => 'required|array',
    'cover_file'   => 'required|mimes:png,jpg,jpeg|max:1200', // 1.2 мегабайта!
    'taxonomy'     => 'nullable|numeric|exists:categories,id',
];
```

# Опубликовать
Controller - `AdminPostController@publish`


POST  - `~/admin/news/{post_id}`


```php
return [
    'is_published' => 'required|boolean'
];
```


## Удалить
Controller - `AdminPostController@delete`

DELETE  - `~/admin/news/{post_id}`


## Массовое удаление
Controller - `AdminPostController@massDeletion`

DELETE  - `~/admin/news/`

```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:posts,id'
];
```

