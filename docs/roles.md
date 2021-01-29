# Роли

## Список ролей
Контроллер - `AdminRoleController@all`

GET - `~/admin/role/list`

Возвращает список ролей с пермишеннами (сортировка идет от количества пермишенов у роли)

`?sort_by=permissions_count&order_by=asc&perPage=15`


params:
```php 
return [
    'perPage'      => 'sometimes|numeric',
    'sort_by'     => [
        'sometimes',
        Rule::in(['name', 'permissions_count'])
    ],
    'order_by' => 'sometimes|in:asc,desc'
];
```

## Список пермишенов
Контроллер - `AdminRoleController@viewPermissions`

GET - `~/admin/role/permissions`

## Создание Роли
Контроллер - `AdminRoleController@create`


POST - `~/admin/role`

Примечание: Тут только создание роли, привязка пермишенов делается отдельно.

Параметр: 
```php
'name' => [
    'required', 'string', 'min:2', 'max:255', 'unique:roles,name'
]
```

## Осмотреть роль
Вернуть данные роли с пермишеннами роли, и пермишеннами которых нет у роли.

Контроллер - `AdminRoleController@show`

GET - `~/admin/role/{role_id}`

## Обновление Роли
Контроллер - `AdminRoleController@update`


PATCH - `~/admin/role/{role_id}`

Примечание: Тут только создание роли, привязка пермишенов делается отдельно.
если у роли essential = true ---- то мы не можем редактировать эту роль
Параметр: 
```php
'name' => [
    'required', 'string', 'min:2', 'max:255', 'unique:roles,name'
]
```

## Удаление роли

Контроллер - `AdminRoleController@delete`

если у роли essential = true ---- то мы не можем редактировать эту роль


DELETE - `~/admin/role/{role_id}`

## Синхронизация роли с пермишенами
Контроллер - `AdminRoleController@syncPermissions`
если у роли essential = true ---- то мы не можем редактировать эту роль


PATCH - `~/admin/role/{role_id}/perms`

Параметр : 

```            php
'permission_ids' => [
  'nullable', 'array', 'exists:permissions,id'
]
```
