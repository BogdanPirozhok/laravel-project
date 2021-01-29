#Список рассылки 
Этот функционал используется для менеджерской рассылки сообщений.
Есть 5 типов форм, по которым отрабатывается рассылка
```
    const VACANCY = 1;
    const TENDER = 2;
    const CONTACT = 3;
    const QUALITY = 4;
    const CATALOG = 5;
```


## Получить определенную рассылку
Controller - `AdminManageMailingListController@show`

GET - `~/admin/mailing-list/{type}` <--- type - это 1,2,3,4,5 (то что выше)


## Обновить рассылку 
Controller - `AdminManageMailingListController@store`

POST - `~/admin/mailing-list`

params: 
нужны type и массив emails.

```php
        return [
            'type' => [
                'required',
                Rule::in([
                    ManagerMailingListSeeder::VACANCY,
                    ManagerMailingListSeeder::TENDER,
                    ManagerMailingListSeeder::CONTACT,
                    ManagerMailingListSeeder::QUALITY,
                    ManagerMailingListSeeder::CATALOG
                ]),
                'numeric'
            ],
            'emails' => [
                'required',
                'array',
            ],
            'emails.*' => [
                'email:filter'
            ]
        ];
```
