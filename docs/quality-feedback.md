# Контроль качества

## Список отзывов
controller - `AdminQualityFeedbackController@list`

GET - `~/admin/quality/list`

`?contact_name=Lark&purchase_place_name=korchma&sort_by=purchase_date&order_by=asc`

params: 

```php 
return [
    'contact_attribute'   => 'sometimes|string',
    'purchase_date'       => 'sometimes|string',
    'purchase_place_name' => 'sometimes|string',
    'contact_name'        => 'sometimes|string',
    'perPage'             => 'sometimes|numeric',
    'sort_by'             => [
        'sometimes',
        Rule::in(['contact_name', 'contact_attribute', 'purchase_date', 'contact_name', 'purchase_place_name'])
    ],
    'order_by'            => 'sometimes|in:asc,desc'
];
```


## Удалить отзыв
controller - `AdminQualityFeedbackController@delete`

DELETE - `~/admin/quality/{id}`

## Массовое удаление отзывов
controller - `AdminQualityFeedbackController@massDeletion`

DELETE - `~/admin/quality/`

```php
return [
    'ids'   => 'required|array',
    'ids.*' => 'exists:quality_feedback,id'
];
```
