# Отзывы о качестве


## Оставить отзыв (на публичной странице сайта. Форма)
Controller - `QualityFeedbackController@store`

POST - `~/quality/form`

Params: 
```php
return [
    'purchase_date'                => 'required|date',
    'purchase_place_name'          => 'required|string',
    'purchase_place_address'       => 'required|string',
    'barcode_file'                 => 'required|mimes:jpeg,jpg,png|max:5000',
    'purchase_product_name'        => 'sometimes|nullable|string',
    'purchase_product_date'        => 'sometimes|nullable|date',
    'purchase_product_barcode'     => 'sometimes|nullable|string',
    'purchase_product_description' => 'required|string',
    'wishes'                       => 'nullable|string',
    'contact_me'                   => 'required|boolean',
    'contact_name'                 => 'required_if:contact_me,1|string',
    'contact_attribute'            => 'required_if:contact_me,1|string',
];
```


## Список отзывов (Дальше все для админки)
Controller - `AdminQualityFeedbackController@list`

GET - `~/admin/quality/list`

params: 
```php
return [
    'perPage' => 'sometimes|numeric'
];
```

## Осмотреть отзыв
Controller - `AdminQualityFeedbackController@view`

GET - `~/admin/quality/{id}`


## Удалить отзыв
Controller - `AdminQualityFeedbackController@delete`

DELETE - `~/admin/quality/{id}`
