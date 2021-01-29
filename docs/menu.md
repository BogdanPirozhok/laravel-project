# Меню

###
Основной компонент прототипа:
`resources/js/prototypes/components/Menu/MenuComponent.vue`
Данные в него передаются через пропс с сервера.
Смотри `Admin\AdminMenuController@index`.
Его blade компонент: `resources/views/admin/menu.blade.php`



## Список меню
Controller - `Admin\AdminMenuController@list`

GET - `~/admin/menu/list`


## Создать меню
Controller - `Admin\AdminMenuController@list`

POST - `~/admin/menu`

Cписок для `menu_position`
```
[
    'nav_menu',
    'footer_menu',
    'social_menu'
]
```

params:
```php 
return [
    'menu_name' => 'required|string|max:255',
    'menu_position' => [
        'nullable',
        Rule::in(config('menu.list'))
    ]
];
```


## Получить меню
Controller - `Admin\AdminMenuController@show`


GET - `~/admin/menu/{menu_id}`

## Обновить содержимое меню
Controller - `Admin\AdminMenuController@update`

PATCH - `~/admin/menu/{menu_id}`

params:
```php 
return [
    'items' => 'nullable|array'
];
```

## Обновить данные меню
Controller - `Admin\AdminMenuController@updateMenu`

PUT - `~/admin/menu/{menu_id}`

Cписок для `menu_position`
```
[
    'nav_menu',
    'footer_menu',
    'social_menu'
]
```

params:
```php
return [
    'menu_name' => 'required|string|max:255',
    'menu_position' => [
        'nullable',
        Rule::in(config('menu.list'))
    ]
];
```

## Удалить меню
Controller - `Admin\AdminMenuController@delete`

DELETE - `~/admin/menu/{menu_id}`



