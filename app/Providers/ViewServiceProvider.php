<?php

namespace App\Providers;

use App\Http\View\Composers\Pages\AboutComposer;
use App\Http\View\Composers\Pages\ContactsComposer;
use App\Http\View\Composers\Pages\LandingComposer;
use App\Http\View\Composers\Pages\CategoriesComposer;
use App\Http\View\Composers\Pages\NetworksComposer;
use App\Http\View\Composers\Pages\NewsComposer;
use App\Http\View\Composers\Pages\PartnershipComposer;
use App\Http\View\Composers\Pages\PolicyComposer;
use App\Http\View\Composers\Pages\PurchasesComposer;
use App\Http\View\Composers\Pages\QualityComposer;
use App\Http\View\Composers\Pages\RecipesComposer;
use App\Http\View\Composers\Pages\ProductsComposer;
use App\Http\View\Composers\Pages\WorkComposer;
use App\Http\View\Composers\Partials\FooterComposer;
use App\Http\View\Composers\Partials\NavbarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('public.partials.footer', FooterComposer::class);
        View::composer('public.partials.header', NavbarComposer::class);

        View::composer('public.pages.home',              LandingComposer::class);
        View::composer('public.pages.categories',        CategoriesComposer::class);
        View::composer('public.pages.partnership.index', PartnershipComposer::class);
        View::composer('public.pages.purchases.index',   PurchasesComposer::class);
        View::composer('public.pages.recipes',           RecipesComposer::class);
        View::composer('public.pages.products',          ProductsComposer::class);
        View::composer('public.pages.news',              NewsComposer::class);
        View::composer('public.pages.work.index',        WorkComposer::class);
        View::composer('public.pages.about',             AboutComposer::class);
        View::composer('public.pages.quality',           QualityComposer::class);
        View::composer('public.pages.networks',          NetworksComposer::class);
        View::composer('public.pages.contacts',          ContactsComposer::class);
        View::composer('public.pages.policy',            PolicyComposer::class);

    }
}
