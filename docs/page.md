
## Типовые страницы

## Список essential страниц
Controller - `AdminPageController@essentialList`

POST - `~/admin/pages/essential`

params:
```php
return [
    'perPage'      => 'sometimes|numeric',
];
```


## Осмотреть essential страницу
Controller - `AdminPageController@essential`

GET - `~/admin/pages/essential/{page_slug}`


## Лендинг  `~/`
Controller - `AdminPageController@landing`


POST - `~/admin/pages/landing`

params:
```php
[
    "title"                     => "required|string",
    "description"               => "nullable|string",
    "meta_title"                => "nullable|string",
    "meta_description"          => "nullable|string",
    
    "body.header"               => "required|array",
    "body.header.title"         => "required|string",
    "body.header.sub_title"     => "nullable|string",
    "body.header.button_url"    => "nullable|string",
    "body.header.button_text"   => "nullable|string",
    "body.header.image_url"     => "nullable|string",
    
    "body.contacts"             => "required|array",
    "body.contacts.*.title"     => "required|string",
    "body.contacts.*.sub_title" => "sometimes|string",
    "body.contacts.*.phone"     => "required_without:body.contacts.*.email|string",
    "body.contacts.*.email"     => "required_without:body.contacts.*.phone|string",
]
```
`.*.` - значит что может быть множество таких массивов.

#Партнерам `~/partnership`
Controller - `AdminPageController@partnership`


POST - `~/admin/pages/partnership`
```php
[
    "title"                    => "required|string",
    "description"              => "nullable|string",
    "meta_title"               => "nullable|string",
    "meta_description"         => "nullable|string",
    
    "body.header"              => "required|array",
    "body.header.title"        => "required|string",
    "body.header.sub_title"    => "nullable|string",
    "body.header.button_url"   => "nullable|string",
    "body.header.button_text"  => "nullable|string",
    "body.header.image_url"    => "nullable|string",
    
    "body.video"               => "required|array",
    "body.video.*.video_url"   => "required|string",
    "body.video.*.preview_url" => "required|string",
]
```

#Закупки/Тендеры `~/purchases`
Controller - `AdminPageController@purchases`


POST - `~/admin/pages/purchases`

```php
[
    "title"                   => "required|string",
    "description"             => "nullable|string",
    "meta_title"              => "nullable|string",
    "meta_description"        => "nullable|string",
    
    "body.header"             => "required|array",
    "body.header.title"       => "required|string",
    "body.header.sub_title"   => "nullable|string",
    "body.header.button_url"  => "nullable|string",
    "body.header.button_text" => "nullable|string",
    "body.header.image_url"   => "nullable|string",
    
    "body.purchased"          => "required",
    "body.purchased.*"        => "nullable|string",
    
    "body.conditions"         => "required",
    "body.conditions.*"       => "nullable|string",
    
    "body.department.phone"   => "required|string",
    "body.department.email"   => "required|string",
]
```

#Рецепты `~/recipes`
Controller - `AdminPageController@recipes`


POST - `~/admin/pages/recipes`

params: 
```php
[
    "title"                   => "required|string",
    "description"             => "nullable|string",
    "meta_title"              => "nullable|string",
    "meta_description"        => "nullable|string",
    
    "body.header"             => "required|array",
    "body.header.title"       => "required|string",
    "body.header.sub_title"   => "nullable|string",
    "body.header.button_url"  => "nullable|string",
    "body.header.button_text" => "nullable|string",
    "body.header.image_url"   => "nullable|string",
]
```

#Работа `~/work`
Controller - `AdminPageController@work`


POST - `~/admin/pages/work`

params:
```php
[
    "title"                              => "required|string",
    "description"                        => "nullable|string",
    "meta_title"                         => "nullable|string",
    "meta_description"                   => "nullable|string",
    
    "body.header"                        => "required|array",
    "body.header.title"                  => "required|string",
    "body.header.sub_title"              => "nullable|string",
    "body.header.button_url"             => "nullable|string",
    "body.header.button_text"            => "nullable|string",
    "body.header.image_url"              => "nullable|string",
    
    "body.video"                         => "required|array",
    "body.video.*.video_url"             => "required|string",
    "body.video.*.preview_url"           => "required|string",

    
    "body.about_company"                 => "required|array",
    "body.about_company.title"           => "required|string",
    "body.about_company.sub_title"       => "required|string",
    "body.about_company.image_url"       => "required|string",
    "body.about_company.buttons"         => "required|array",
    "body.about_company.buttons.*.title" => "required|string",
    "body.about_company.buttons.*.url"   => "required|string",
    
    "body.hr.title"                      => "required|string",
    "body.hr.sub_title"                  => "required|string",
    "body.hr.phone"                      => "required|string",
    "body.hr.email"                      => "required|string",
    "body.hr.photo"                      => "required|string",
    "body.hr.name"                       => "required|string",
    "body.hr.position"                   => "required|string",
]
```

#О нас `~/about`
Controller - `AdminPageController@about`


POST - `~/admin/pages/about`

params:
```php
[
    "title"                              => "required|string",
    "description"                        => "nullable|string",
    "meta_title"                         => "nullable|string",
    "meta_description"                   => "nullable|string",
    
    "body.header"                        => "required|array",
    "body.header.title"                  => "required|string",
    "body.header.sub_title"              => "nullable|string",
    "body.header.button_url"             => "nullable|string",
    "body.header.button_text"            => "nullable|string",
    "body.header.image_url"              => "nullable|string",
    
    "body.about_company"                 => "required|array",
    "body.about_company.title"           => "required|string",
    "body.about_company.sub_title"       => "required|string",
    "body.about_company.image_url"       => "required|string",
    "body.about_company.buttons"         => "required|array",
    "body.about_company.buttons.*.title" => "required|string",
    "body.about_company.buttons.*.url"   => "required|string",
]
```

#Контроль качества `~/quality`
Controller - `AdminPageController@quality`


POST - `~/admin/pages/quality`

params:
```php
[
    "title"                   => "required|string",
    "description"             => "nullable|string",
    "meta_title"              => "nullable|string",
    "meta_description"        => "nullable|string",
    
    "body.header"             => "required|array",
    "body.header.title"       => "required|string",
    "body.header.sub_title"   => "nullable|string",
    "body.header.button_url"  => "nullable|string",
    "body.header.button_text" => "nullable|string",
    "body.header.image_url"   => "nullable|string",
    
    "body.qs.phone"           => "required|string",
]
```

#Контакты `~/contacts`
Controller - `AdminPageController@contacts`


POST - `~/admin/pages/contacts`

params:
```php
[
    "title"                     => "required|string",
    "description"               => "nullable|string",
    "meta_title"                => "nullable|string",
    "meta_description"          => "nullable|string",
    
    "body.header"               => "required|array",
    "body.header.title"         => "required|string",
    "body.header.sub_title"     => "nullable|string",
    "body.header.button_url"    => "nullable|string",
    "body.header.button_text"   => "nullable|string",
    "body.header.image_url"     => "nullable|string",
    
    "body.contacts"             => "required|array",
    "body.contacts.*.title"     => "required|string",
    "body.contacts.*.sub_title" => "sometimes|string",
    "body.contacts.*.phone"     => "required_without:body.contacts.*.email|string",
    "body.contacts.*.email"     => "required_without:body.contacts.*.phone|string",
]
```

# Новости `~/news`
Controller - `AdminPageController@news`

POST - `~/admin/pages/news`

```php
[
    "title"            => "required|string",
    "description"      => "nullable|string",
    "meta_title"       => "nullable|string",
    "meta_description" => "nullable|string",
]
```


## `~/categories`
Controller - `AdminPageController@categories`

POST - `~/admin/pages/categories`


params
```php
[
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",

     "body.product_slider" => "required",
     "body.conditions.*.title" => "required|string",
     "body.conditions.*.description" => "required|string",
     "body.conditions.*.src" => "required|string",
     "body.conditions.*.url" => "required|string",
   ]

```


## `~/policy`
Controller - `AdminPageController@policy`

POST - `~/admin/pages/policy`

params:
```php
[
     "body.html" => "nullable",
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",
   ]
```


## '~/products/vse-produkty/'
Controller - `AdminPageController@products`

POST - `~/admin/pages/products`

params: 
```php
[
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",
     "body.header" => "required|array",
     "body.header.title" => "required|string",
     "body.header.sub_title" => "nullable|string",
     "body.header.button_url" => "nullable|string",
     "body.header.button_text" => "nullable|string",
     "body.header.image_url" => "nullable|string",
   ]

```



## Сети и дистрибьюторы `~/networks`
Controller - `AdminPageController@networks`

POST - `~/admin/pages/networks`

params
```php
[
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",
     "body.header" => "required|array",
     "body.header.title" => "required|string",
     "body.header.sub_title" => "nullable|string",
     "body.header.button_url" => "nullable|string",
     "body.header.button_text" => "nullable|string",
     "body.header.image_url" => "nullable|string",
   ]
```




# Отдельные типовые страницы

## Список страниц
Controller - `AdminPageController@list`

GET - `~/admin/pages/list`


params: 
```php
return [
    'perPage'      => 'sometimes|numeric',
];
```

## Создать страницу
Controller - `AdminPageController@create`

POST - `~/admin/pages`

`slug` -  зависит от того что есть в базе, обращайся к `~/admin/pages/blacklist `чтобы получить список слагов которые создать нельзя
```php
    "slug" => [
        "bail",
        "required",
        "string",
        Illuminate\Validation\Rules\NotIn {#3710},
        "max:255",
     ],
     "is_published" => "sometimes|required|boolean",
     "body.html" => "nullable",
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",
     "body.header" => "sometimes|array",
     "body.header.title" => "sometimes|string",
     "body.header.sub_title" => "nullable|string",
     "body.header.button_url" => "nullable|string",
     "body.header.button_text" => "nullable|string",
     "body.header.image_url" => "nullable|string",
   ]
```



## Обновить страницу
Controller - `AdminPageController@update`

PATCH - `~/admin/pages/{page_id}`


`slug` -  зависит от того что есть в базе, обращайся к `~/admin/pages/blacklist `чтобы получить список слагов которые создать нельзя

```php
[
    "slug" => [
        "bail",
        "required",
        "string",
        Illuminate\Validation\Rules\NotIn {#4656},
        "max:255",
     ],
     "is_published" => "sometimes|required|boolean",
     "body.html" => "nullable",
     "title" => "required|string",
     "description" => "nullable|string",
     "meta_title" => "nullable|string",
     "meta_description" => "nullable|string",
     "body.header" => "sometimes|array",
     "body.header.title" => "sometimes|string",
     "body.header.sub_title" => "nullable|string",
     "body.header.button_url" => "nullable|string",
     "body.header.button_text" => "nullable|string",
     "body.header.image_url" => "nullable|string",
   ]
```

## Опубликовать\Распубликовать страницу
Controller - `AdminPageController@publish`

PATCH - `~/admin/pages/{page_id}/publish`

```php
return [
    'is_published' => 'required|boolean'
];
```


## Осмотреть страницу
Controller - `AdminPageController@show`

GET - `~/admin/pages/{page_id}`


## Удалить страницу
Controller - `AdminPageController@delete`

DELETE - `~/admin/pages/{page_id}`
