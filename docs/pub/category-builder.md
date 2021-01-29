# Билдер ссылок для категорий

Сейчас есть два типа билдеров `CategoryNestedUri` (`/kategorii_goryacie-zakuski`) и 
`CategoryRozetkaUri` (`/kategorii=goryacie-zakuski`). Используем `CategoryNestedUri`.

У `CategoryNestedUri` делиметры:
- `/` -- между фильтрами
- `_` -- между параметрами

`/kategorii_goryacie-zakuski/sloznost-prigotovleniya_legko-gotovit`


Ссылка-пример: http://pirat.test/recipe-cat/vse-recepty/kategorii_goryacie-zakuski

Для каждой модели нужно делать кастомный биндинг (https://laravel.com/docs/7.x/routing#explicit-binding)

Сейчас биндинг есть только для `recipe_category` т.е. рецептов:


```php
Route::get('/recipe-cat/{recipe_category}/{params?}', 'CategoryController@show')->where(['params' => '.*']);

// ЭТО И ЕСТЬ БИНДИНГ
Route::bind('recipe_category', function ($value) {
    return app('rinvex.categories.category')
        ->where('slug', $value)
        ->where('behavior_type', 'category')
        ->where('related_to', \App\Models\Recipe::class)
        ->first();
});
```

`recipe_category` --  наша главная категорий (`vse-recepty` или `vse-produkty`)

`CategoryController` - использовался для тестов. По этому нужно будет логику подвинуть под свой контроллер.
Сейчас там возвращается массив с используемыми фильтрами, выбранными фильтрами, урлом и НЕ ПАГИНИРОВАННЫМ списком рецептов.





