
# Роуты для работы с пользователями 

## Пермишены у пользователя
Контроллер: `AdminController@check`

GET - `~/admin/check` - роут для получения пермишенов пользователя, будет возвращаться вот такой массив данных:


```php
[
       "view admin",
       "manage users",
       "manage roles",
       "manage pages",
       "manage menu",
       "manage category",
       "manage product",
       "manage recipe",
       "manage vacancy",
       "manage tender",
       "manage review",
       "manage post",
       "manage map",

]
```
И это нужно будет хранить во вьюексе и сделать соответсвующую диррективу, которая будет определать может ли пользователь 
видеть что-то или выполнить какое-то действие, если у него есть пермишен.
Типа:
 
 `<div v-can="view users"> Data </div>` 
 
И подобное для роутов.


## Текущий авторизированный пользователь
Контроллер `AdminUserController@current`

GET - `~/admin/user/current`


## Список пользователей
Контроллер `AdminUserController@all`

GET - `~/admin/user/list` - возвращает список пользователей с ролями.  Есть пагинацией


`?sort_by=name&order_by=desc`

params:
```php  
return [
    'perPage' => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'email'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```


response:

```json
{
    "data": [
    {
        "name": "Super-Admin",
        "email": "email@domain.com",
        "created_at": "2020-11-18T09:18:55.000000Z",
        "role": [
            "admin"
        ]
    },
    {
        "name": "MAGE",
        "email": "mage@domain.com",
        "created_at": "2020-11-18T09:18:55.000000Z",
        "role": [
            "mage"
        ]
    }
    ...
}
```

## Создать пользователя
Контроллер `AdminUserController@update`
POST - `~/admin/user/create/`

params: 
```php 
return [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'string', 'min:8', 'confirmed'],
    // password_confirmation как password
];
```


## Показать определенного пользователя
Контроллер `AdminUserController@show`

GET - `~/admin/user/{user_id?}`


```json
{
    "data": {
    "name": "Super-Admin",
    "email": "email@domain.com",
    "created_at": "2020-11-18T09:18:55.000000Z",
    "role": [
        "admin"
        ]
    }
}
```

## Отредактировать пользователя (без пароля)
Контроллер `AdminUserController@update`

POST - `~/admin/user/{user_id?}`
Если `{user_id?}` не стоит, то все меняется на текущем пользователе
params:

```php 
return [
    'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users'],
    'name' => ['sometimes', 'string', 'max:255'],
    'avatar' => 'sometimes|mimes:jpg,png|max:800',
];
```

## Изменить пароль пользователя
Контроллер `AdminUserController@updatePassword`

PUT - `~/admin/user/{user_id?}`
Если `{user_id?}` не стоит, то все меняется на текущем пользователе

params:

```php
return [
    'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
    // password_confirmation <-- как password выше
];
```


## Привязать роль к пользователю
Контроллер `AdminUserController@syncRole`

PATCH - `~/admin/user/{user_id}` 

Параметр `'role_id' => 'nullable|integer'`

`role_id: null` - значит снять роль с пользователя

`role_id: 1` - привязать к пользователю роль под ИДом 1. Передавать не массив, а одиночное значение.

Список ролей смотреть в `roles.md`

## Удалить пользователя
Контроллер `AdminUserController@delete`

DELETE - `~/admin/user/{user_id}`


