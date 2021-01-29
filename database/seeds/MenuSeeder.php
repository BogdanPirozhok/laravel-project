<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{

    protected $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // nav menu (navbar)
        $this->seedNavbar();
        // social menu
        $this->seedSocial();
        // footer menu
        $this->seedFooter();

    }


    /**
     * Seed navbar
     *
     * @return void
     */
    protected function seedNavbar(): void
    {
        $menu = Menu::create([
            'menu_name'     => 'Navbar menu',
            'menu_position' => 'nav_menu',
            'taxonomy'      => Menu::NAV_MENU,
        ]);

        $item_products = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '/categories',
            'item_caption' => 'ПРОДУКЦИЯ',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_for_business = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '#',
            'item_caption' => 'БИЗНЕСУ',
            'item_target'  => '_self',
            'order'        => 1,
        ]);

        $item_for_business_1 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_for_business->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/partnership',
            'item_caption'     => 'ПАРТНЕРАМ',
            'item_description' => 'Выгодные условия сотрудничества',
            'item_icon'        => '/library/public/img/partners.svg',
            'item_target'      => '_self',
            'order'            => 0,
        ]);

        $item_for_business_2 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_for_business->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/purchases',
            'item_caption'     => 'ЗАКУПКИ',
            'item_description' => 'Участие в тендерах',
            'item_icon'        => '/library/public/img/procurement.svg',
            'item_target'      => '_self',
            'order'            => 1,
        ]);


        $item_recipes = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '/recipes',
            'item_caption' => 'РЕЦЕПТЫ',
            'item_target'  => '_self',
            'order'        => 2,
        ]);

        $item_news = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '/news',
            'item_caption' => 'НОВОСТИ',
            'item_target'  => '_self',
            'order'        => 3,
        ]);

        $item_work = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '/work',
            'item_caption' => 'РАБОТА',
            'item_target'  => '_self',
            'order'        => 4,
        ]);

        $item_about_company = Menu::create([
            'item_menu_id' => $menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_url'     => '#',
            'item_caption' => 'О КОМПАНИИ',
            'item_target'  => '_self',
            'order'        => 5,
        ]);

        $item_about_company_1 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_about_company->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/about',
            'item_caption'     => 'О НАС',
            'item_description' => 'Узнать о компании подробнее',
            'item_icon'        => '/library/public/img/heart.svg',
            'item_target'      => '_self',
            'order'            => 0,
        ]);

        $item_about_company_2 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_about_company->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/quality',
            'item_caption'     => 'КОНТРОЛЬ КАЧЕСТВА',
            'item_description' => 'Высокие стандарты качества',
            'item_icon'        => '/library/public/img/like.svg',
            'item_target'      => '_self',
            'order'            => 1,
        ]);

        $item_about_company_3 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_about_company->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/networks',
            'item_caption'     => 'СЕТИ И ДИСТРИБЬЮТОРЫ',
            'item_description' => 'Узнать где приобрести',
            'item_icon'        => '/library/public/img/map-ico.svg',
            'item_target'      => '_self',
            'order'            => 2,
        ]);

        $item_about_company_4 = Menu::create([
            'item_menu_id'     => $menu->id,
            'item_parent'      => $item_about_company->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => '/contacts',
            'item_caption'     => 'КОНТАКТЫ',
            'item_description' => 'Связаться удобным способом',
            'item_icon'        => '/library/public/img/phone.svg',
            'item_target'      => '_self',
            'order'            => 3,
        ]);


    }

    /**
     * Seed social menu
     *
     * @return void
     */
    protected function seedSocial(): void
    {
        $social = Menu::create([
            'menu_name'     => 'Social menu',
            'menu_position' => 'social_menu',
            'taxonomy'      => Menu::NAV_MENU,
        ]);
        $item_social = Menu::create([
            'item_menu_id'     => $social->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => $this->faker->url,
            'item_description' => $this->faker->text(20),
            'item_icon'        => $this->faker->imageUrl(),
            'item_caption'     => 'Facebook',
            'item_target'      => '_blank',
            'order'            => 0,
        ]);

        $item_social_1 = Menu::create([
            'item_menu_id'     => $social->id,
            'taxonomy'         => Menu::MENU_ITEM,
            'item_url'         => $this->faker->url,
            'item_description' => $this->faker->text(20),
            'item_icon'        => $this->faker->imageUrl(),
            'item_caption'     => 'Instagram',
            'item_target'      => '_blank',
            'order'            => 1,
        ]);
    }

    /**
     * Seed footer menu
     *
     * @return void
     */
    protected function seedFooter(): void
    {

        $footer_menu = Menu::create([
            'menu_name'     => 'Footer Menu',
            'menu_position' => 'footer_menu',
            'taxonomy'      => Menu::NAV_MENU,
        ]);

        $item_footer_partner = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'ПАРТНЕРАМ',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_partner_1 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_partner->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Сотрудничество',
            'item_url'     => '/partnership',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_partner_2 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_partner->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Закупки',
            'item_url'     => '/purchases',
            'item_target'  => '_self',
            'order'        => 1,
        ]);

        $item_footer_links = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'ССЫЛКИ',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_links_1 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_links->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Работа',
            'item_url'     => '/work',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_links_2 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_links->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Каталог',
            'item_url'     => '/catalog',
            'item_target'  => '_self',
            'order'        => 1,
        ]);

        $item_footer_links_3 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_links->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Новости',
            'item_url'     => '/news',
            'item_target'  => '_self',
            'order'        => 2,
        ]);

        $item_footer_links_4 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_links->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Рецепты',
            'item_url'     => '/recipes',
            'item_target'  => '_self',
            'order'        => 3,
        ]);

        $item_footer_company = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'КОМПАНИЯ',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_company_1 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_parent'  => $item_footer_company->id,
            'item_caption' => 'О нас',
            'item_url'     => '/about',
            'item_target'  => '_self',
            'order'        => 0,
        ]);

        $item_footer_company_2 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_company->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Контроль качества',
            'item_url'     => '/quality',
            'item_target'  => '_self',
            'order'        => 1,
        ]);

        $item_footer_company_3 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_company->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Сети и дистрибьюторы',
            'item_url'     => '/networks',
            'item_target'  => '_self',
            'order'        => 2,
        ]);

        $item_footer_company_4 = Menu::create([
            'item_menu_id' => $footer_menu->id,
            'item_parent'  => $item_footer_company->id,
            'taxonomy'     => Menu::MENU_ITEM,
            'item_caption' => 'Контакты',
            'item_url'     => '/contacts',
            'item_target'  => '_self',
            'order'        => 3,
        ]);
    }
}
