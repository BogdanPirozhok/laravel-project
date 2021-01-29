<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/* ------ ABOUT ------ */
Route::get('/about', function () {
    return view('public.pages.about');
});

/* ------ PUBLIC PAGES ------ */
Route::namespace('PublicSite')->group(function () {
    Route::get('/',                  'HomeController@index');
    Route::get('/categories',        'CategoriesController@index');
    Route::get('/recipes',           'CatalogController@recipeShow');
    Route::get('/recipe/{recipe}',   'RecipeController@index');
    Route::get('/product/{product}', 'ProductController@index');
    Route::get('/news/{category?}',  'NewsController@index');
    Route::get('/policy',  function() {
        return view('public.pages.policy');
    });

    /* ------ PRODUCTS CATALOG ------ */
    Route::get('/products/{product_catalog}/{params?}', 'CatalogController@productCatalog')->where(['params' => '.*']);
    Route::bind('product_catalog', function ($value) {
        return app('rinvex.categories.category')
            ->where([
                ['slug', $value],
                ['behavior_type', 'category'],
                ['related_to', \App\Models\Product::class],
            ])
            ->first();
    });

    /* ------ RECIPES CATALOG ------ */
    Route::get('/recipes/{recipe_catalog}/{params?}', 'CatalogController@recipeCatalog')->where(['params' => '.*']);
    Route::bind('recipe_catalog', function ($value) {
        return app('rinvex.categories.category')
            ->where([
                ['slug', $value],
                ['behavior_type', 'category'],
                ['related_to', \App\Models\Recipe::class],
            ])
            ->first();
    });

    /* ------ CONTACTS ------ */
    Route::prefix('contacts')->group(function() {
        Route::get('/',  'ContactController@index');
        Route::post('/', 'ContactController@form');
    });

    /* ----- PARTNERSHIP ----- */
    Route::prefix('partnership')->group(function() {
        Route::get('/', 'PartnershipController@index');

        Route::prefix('form')->group(function() {
            Route::get('/',  'PartnershipController@form');
            Route::post('/', 'PartnershipController@storeTenderRequest');
        });
    });

    /* ---- TENDERS\PURCHASES ---- */
    Route::prefix('purchases')->group(function() {
        Route::get('/',     'TenderController@index');
        Route::get('/ajax', 'TenderController@ajax');
        Route::post('/',    'TenderController@storeTenderRequest');
    });

    /* ---- VACANCIES\WORK ---- */
    Route::prefix('work')->group(function() {
        Route::get('/', 'VacancyController@index');

        Route::prefix('vacancy')->group(function() {
            Route::get('/',          'VacancyController@vacancyList');
            Route::post('/',         'VacancyController@inquiry');
            Route::get('/{vacancy}', 'VacancyController@show')->name('public.vacancy.view');
        });
    });

    /* ------ QA ------ */
    Route::prefix('quality')->group(function() {
        // main page with all quality stuff
        Route::get('/', function () {
            return view('public.pages.quality');
        });

        // form for quality feedback
        Route::prefix('form')->group(function() {
            Route::get('/',  'QualityFeedbackController@feedback');
            Route::post('/', 'QualityFeedbackController@store');
        });
    });

    /* ------ NETWORKS ------ */
    Route::get('/networks', 'MapController@index');

    Route::prefix('map')->group(function() {
        Route::get('/networks', 'MapController@networks');
        Route::get('/search',   'MapController@search');

        Route::prefix('points')->group(function() {
            Route::get('/list',    'MapController@points');
            Route::get('/{point}', 'MapController@viewPoint');
        });
    });

    /* ----- TYPICAL PAGES ----- */
    Route::get('/{typical_slug}', 'PageController@show');
    Route::bind('typical_slug', function ($value) {
        return App\Models\Page::where([
                ['essential', false],
                ['slug',      $value]
            ])
            ->firstOrFail();
    });
});
