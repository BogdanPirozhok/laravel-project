<?php

namespace App\Providers;

use App\Models\CatalogRequest;
use App\Models\ContactRequest;
use App\Models\ManagerMailingList;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Point;
use App\Models\Post;
use App\Models\Product;
use App\Models\QualityFeedback;
use App\Models\Recipe;
use App\Models\StoreNetwork;
use App\Models\Tender;
use App\Models\TenderRequest;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\VacancyInquirer;
use App\Policies\CatalogRequestPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ContactRequestPolicy;
use App\Policies\ManagerMailingListPolicy;
use App\Policies\MenuPolicy;
use App\Policies\PagePolicy;
use App\Policies\PointPolicy;
use App\Policies\PostPolicy;
use App\Policies\ProductPolicy;
use App\Policies\QualityPolicy;
use App\Policies\RecipePolicy;
use App\Policies\RolePolicy;
use App\Policies\StoreNetworkPolicy;
use App\Policies\TenderPolicy;
use App\Policies\TenderRequestPolicy;
use App\Policies\UserPolicy;
use App\Policies\VacancyInquirerPolicy;
use App\Policies\VacancyPolicy;
use App\Repositories\Category\Models\Category;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class               => UserPolicy::class,
        Role::class               => RolePolicy::class,
        Page::class               => PagePolicy::class,
        Menu::class               => MenuPolicy::class,
        Category::class           => CategoryPolicy::class,
        Product::class            => ProductPolicy::class,
        Recipe::class             => RecipePolicy::class,
        Vacancy::class            => VacancyPolicy::class,
        Tender::class             => TenderPolicy::class,
        QualityFeedback::class    => QualityPolicy::class,
        Post::class               => PostPolicy::class,
        StoreNetwork::class       => StoreNetworkPolicy::class,
        Point::class              => PointPolicy::class,
        ContactRequest:: class    => ContactRequestPolicy::class,
        CatalogRequest::class     => CatalogRequestPolicy::class,
        ManagerMailingList::class => ManagerMailingListPolicy::class,
        TenderRequest::class      => TenderRequestPolicy::class,
        VacancyInquirer::class    => VacancyInquirerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
