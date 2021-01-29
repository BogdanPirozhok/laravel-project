<?php

use Illuminate\Database\Seeder;
use App\Models\Template;
use App\Models\Page;

class PageAndTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = Template::create([
            'name'      => 'Base template',
            'path'      => 'templates.base',
            'is_editor' => true
        ]);

        $this->seedLanding($template);

        $this->seedPartnership($template);

        $this->seedPurchases($template);

        $this->seedRecipes($template);

        $this->seedProducts($template);

        $this->seedWork($template);

        $this->seedAbout($template);

        $this->seedQuality($template);

        $this->seedNetworks($template);

        $this->seedContacts($template);

        $this->seedNews($template);

        $this->seedCategories($template);

        $this->seedPolicy($template);
    }


    /**
     * Seeding landing page data
     *
     * @param $template
     */
    private function seedLanding($template)
    {
        Page::create([
            'title'            => 'DELSY LANDING',
            'description'      => 'DELSY LANDING',
            'meta_title'       => 'DELSY LANDING',
            'meta_description' => 'DELSY LANDING',
            'slug'             => \Illuminate\Support\Str::slug('landing'),
            'body'             => [
                'header'   => [
                    'title'       => 'Вкусная компания',
                    'sub_title'   => 'Лидирующий производитель рыбных продуктов в восточной части России',
                    'button_url'  => '/categories',
                    'button_text' => 'ПОСМОТРЕТЬ КАТАЛОГ',
                    'image_url'   => '/library/public/img/image-hero.svg',
                ],
                'contacts' => [
                    [
                        'title'     => 'Завод',
                        'sub_title' => 'Российская Федерация, 662500, Красноярский край, г. Сосновоборск, ул. Заводская, 1 корпус 40',
                        'phone'     => '+7 (391) 256-00-66',
                    ],
                    [
                        'title' => 'Служба качества (звонки по России бесплатные)',
                        'phone' => '+7 (800) 600-59-63',
                        'email' => 'example@dot.com'
                    ],
                    [
                        'title' => 'Отдел оптовых заказов для магазинов и торговых сетей',
                        'phone' => '+7 (391) 256-00-60',
                    ],
                    [
                        'title' => 'Отдел кадров',
                        'phone' => '+7 (913) 567-27-87',
                    ]
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,
        ]);
    }

    /**
     * Seed partnership page data
     *
     * @param $template
     */
    private function seedPartnership($template)
    {
        Page::create([
            'title'            => 'DELSY PARTNERSHIP',
            'description'      => 'DELSY PARTNERSHIP',
            'meta_title'       => 'DELSY PARTNERSHIP',
            'meta_description' => 'DELSY PARTNERSHIP',
            'slug'             => \Illuminate\Support\Str::slug('partnership'),
            'body'             => [
                'header' => [
                    'title'     => 'Партнёрам',
                    'sub_title' => 'Делси является лидирующим производителем рыбных продуктов в восточной части России',
                    'image_url' => '/library/public/img/partnership-img-1.jpg',
                ],
                'video'  => [
                    [
                        'video_url'   => 'https://www.youtube.com/embed/-LPcazCEivQ',
                        'preview_url' => 'http://i3.ytimg.com/vi/-LPcazCEivQ/maxresdefault.jpg',
                    ],
                    [
                        'video_url'   => 'https://www.youtube.com/embed/HKUt8ekOb8Q',
                        'preview_url' => 'http://i3.ytimg.com/vi/HKUt8ekOb8Q/maxresdefault.jpg',
                    ],
                    [
                        'video_url'   => 'https://www.youtube.com/embed/FT6ClwK6juw',
                        'preview_url' => 'http://i3.ytimg.com/vi/FT6ClwK6juw/maxresdefault.jpg',
                    ],
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);

    }

    /**
     * Seed purchase and tender page data
     *
     * @param $template
     */
    private function seedPurchases($template)
    {
        Page::create([
            'title'            => 'DELSY PURCHASES',
            'description'      => 'DELSY PURCHASES',
            'meta_title'       => 'DELSY PURCHASES',
            'meta_description' => 'DELSY PURCHASES',
            'slug'             => \Illuminate\Support\Str::slug('purchases'),
            'body'             => [
                'header'     => [
                    'title'     => 'Закупки',
                    'sub_title' => 'Приглашаем к сотрудничеству поставщиков сырья и оборудования, расходных материалов, производителей упаковки. Делси - требовательный, но надежный и выгодный партнёр на долгие времена',
                    'image_url' => '/library/public/img/purchases.jpg',
                ],
                'purchased'  => [
                    'Горбуша св/м б/г',
                    'Кальмар св/м',
                    'Камбала св/м н/р',
                    'Камбала св/м б/г',
                    'Капуста морская св/м',
                    'Капуста морская сушеная',
                    'Килька Балтийская св/м',
                    'Мидии в/м очищенные 300/500',
                    'Путассу св/м',
                    'Сельдь св/м Иваси',
                    'Сельдь св/м т/о',
                    'Филе сельди т/о',
                    'Форель св/м б/г 1,8-2,7',
                    'Форель охл 2-3'
                ],
                'conditions' => [
                    'предложение потенциального претендента содержит наиболее разумное соотношение цены и качества товара в сравнении с другими претендентами аналогичного товара;',
                    'предпочтение отдается претендентам, имеющим возможность предоставления цен, максимально приближенным к себестоимости товара, возможность поставки товара с отсрочкой платежа в соответствии с законодательством РФ, а также возможность поддержания максимального уровня исполнения заказов;',
                    'качество и безопасность товара, упаковки товара должно соответствовать требованиям санитарных, технических норм законодательства РФ, Таможенного союза, ЕАЭС;',
                    'претендент должен осуществлять деятельность в строгом соответствии с законодательством РФ;',
                    'должен быть зарегистрирован в установленном законом порядке в качестве юридического лица или индивидуального предпринимателя;',
                    'обладать всеми необходимыми лицензиями и разрешениями;',
                    'не находится в стадии ликвидации или банкротства;',
                    'не иметь задолженность перед государством или другими компаниями;',
                    'надежность претендента (на основании отзывов, рекомендаций и другой информации о претенденте);',
                    'соответствие поставляемых товаров, работ (услуг) конкретным техническим регламентам (нормативным актам) РФ и ТС',
                ],
                'department' => [
                    'phone' => '+7 (391) 256 00 66',
                    'email' => 'omts@delsy.ru',
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);
    }

    /**
     * seed recipes page data
     *
     * @param $template
     */
    private function seedRecipes($template)
    {
        Page::create([
            'title'            => 'DELSY RECIPES',
            'description'      => 'DELSY RECIPES',
            'meta_title'       => 'DELSY RECIPES',
            'meta_description' => 'DELSY RECIPES',
            'slug'             => \Illuminate\Support\Str::slug('recipes'),
            'body'             => [
                'header' => [
                    'title'     => 'Вкусные рецепты',
                    'sub_title' => 'Завтрак, снеки, отдых с друзьями, семейный обед или торжественный ужин, в ассортименте Делси легко найдется подходящий вкусный и полезный продукт. Мы всегда стараемся радовать своих покупателей вкусными и полезными новинками.',
                    'image_url' => '/library/public/img/recipes-1mg-1.jpg',
                ],
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);
    }

    /**
     * seed recipes page data
     *
     * @param $template
     */
    private function seedProducts($template)
    {
        Page::create([
            'title'            => 'DELSY PRODUCTS',
            'description'      => 'DELSY PRODUCTS',
            'meta_title'       => 'DELSY PRODUCTS',
            'meta_description' => 'DELSY PRODUCTS',
            'slug'             => \Illuminate\Support\Str::slug('products'),
            'body'             => [
                'header' => [
                    'title'     => 'Наша продукция',
                    'sub_title' => 'Завтрак, снеки, отдых с друзьями, семейный обед или торжесвенный ужин, в ассортименте Делси легко найдется подходящий вкусный и полезный продукт. Мы всегда стараемся радовать своих покупателей вкусными и полезными новинками.',
                    'image_url' => '/library/public/img/filter-img-1.jpg',
                ],
            ],
            'template_id'      => $template->id,
            'essential'        => true
        ]);
    }

    /**
     * Seed work page data
     *
     * @param $template
     */
    private function seedWork($template)
    {
        Page::create([
            'title'            => 'DELSY WORK',
            'description'      => 'DELSY WORK',
            'meta_title'       => 'DELSY WORK',
            'meta_description' => 'DELSY WORK',
            'slug'             => \Illuminate\Support\Str::slug('work'),
            'body'             => [
                'header'        => [
                    'title'     => 'Работа в Делси',
                    'sub_title' => 'История компании — это не только рост объемов производства, числа постоянных покупателей и узнаваемости бренда, но и история профессионального развития команды Делси',
                    'image_url' => '/library/public/img/work__img-bg.jpg',
                ],
                'about_company' => [
                    'title'     => 'Узнайте больше о работе в нашей компании',
                    'sub_title' => 'Что такое работать в Делси и что компания предлагает своим работникам:',
                    'image_url' => '/library/public/img/more-about__img.jpg',
                    'buttons'   => [
                        [
                            'title' => 'Корпоративная культура',
                            'url'   => '/'
                        ],
                        [
                            'title' => 'Ценностное предложение',
                            'url'   => '/'
                        ]
                    ]
                ],
                'hr'            => [
                    'title'     => 'Cвяжитесь с нашим HR',
                    'sub_title' => 'Если у вас остались вопросы или вы не нашли подходящую вакансию',
                    'phone'     => '1234567890',
                    'email'     => 'work@delsy.ru',
                    'photo'     => '/library/public/img/HR.jpg',
                    'name'      => 'Александра Серова',
                    'position'  => 'HR компании Делси',
                ],
                'video'         => [
                    [
                        'video_url'   => 'https://www.youtube.com/embed/-LPcazCEivQ',
                        'preview_url' => 'http://i3.ytimg.com/vi/-LPcazCEivQ/maxresdefault.jpg',
                    ],
                    [
                        'video_url'   => 'https://www.youtube.com/embed/HKUt8ekOb8Q',
                        'preview_url' => 'http://i3.ytimg.com/vi/HKUt8ekOb8Q/maxresdefault.jpg',
                    ],
                    [
                        'video_url'   => 'https://www.youtube.com/embed/FT6ClwK6juw',
                        'preview_url' => 'http://i3.ytimg.com/vi/FT6ClwK6juw/maxresdefault.jpg',
                    ],
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);
    }

    /**
     * Seed about page data
     *
     * @param $template
     */
    private function seedAbout($template)
    {
        Page::create([
            'title'            => 'DELSY ABOUT',
            'description'      => 'DELSY ABOUT',
            'meta_title'       => 'DELSY ABOUT',
            'meta_description' => 'DELSY ABOUT',
            'slug'             => \Illuminate\Support\Str::slug('about'),
            'body'             => [
                'header'        => [
                    'title'     => 'О нас',
                    'sub_title' => 'Завод Делси находится в пригороде Красноярска, городе Сосновоборск. Компания основана в 1995 году. Основной вид деятельности - промышленная переработка и реализация высококачественной рыбной продукции – рыбы океанического промысла и морепродуктов.',
                    'image_url' => '/library/public/img/about__bg.jpg',
                ],
                'about_company' => [
                    'title'     => 'Узнайте больше о работе в нашей компании',
                    'sub_title' => 'Что такое работать в Делси и что компания предлагает своим работникам:',
                    'image_url' => '/library/public/img/more-about__img.jpg',
                    'buttons'   => [
                        [
                            'title' => 'Корпоративная культура',
                            'url'   => '/'
                        ],
                        [
                            'title' => 'Ценностное предложение',
                            'url'   => '/'
                        ]
                    ]
                ],
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);

    }

    /**
     * Seed quality page data
     *
     * @param $template
     */
    private function seedQuality($template)
    {
        Page::create([
            'title'            => 'DELSY QUALITY',
            'description'      => 'DELSY QUALITY',
            'meta_title'       => 'DELSY QUALITY',
            'meta_description' => 'DELSY QUALITY',
            'slug'             => \Illuminate\Support\Str::slug('quality'),
            'body'             => [
                'header' => [
                    'title'       => 'Контроль качества',
                    'sub_title'   => 'Благодаря тщательному отбору сырья и ингредиентов, современному высокотехнологичному оборудованию и полному циклу производства, продукция Делси соответствует самым высоким стандартам качества.',
                    'image_url'   => '/library/public/img/quality__img-bg.jpg',
                    'button_text' => 'ЗАПОЛНИТЬ АНКЕТУ О КАЧЕСТВЕ',
                    'button_url'  => '/quality/form',
                ],
                'qs'     => [
                    'phone' => '789012347890'
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);

    }

    /**
     * Seed networks page data
     *
     * @param $template
     */
    private function seedNetworks($template)
    {
        Page::create([
            'title'            => 'DELSY NETWORKS',
            'description'      => 'DELSY NETWORKS',
            'meta_title'       => 'DELSY NETWORKS',
            'meta_description' => 'DELSY NETWORKS',
            'slug'             => \Illuminate\Support\Str::slug('networks'),
            'body'             => [
                'header' => [
                    'title'     => 'Сети и дистрибьюторы',
                    'image_url' => '/library/public/img/networks__bg.jpg',
                ],
            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);
    }

    /**
     * Seed contacts page data
     *
     * @param $template
     */
    private function seedContacts($template)
    {
        Page::create([
            'title'            => 'DELSY CONTACTS',
            'description'      => 'DELSY CONTACTS',
            'meta_title'       => 'DELSY CONTACTS',
            'meta_description' => 'DELSY CONTACTS',
            'slug'             => \Illuminate\Support\Str::slug('contacts'),
            'body'             => [
                'header'   => [
                    'title'     => 'Контакты',
                    'image_url' => '/library/public/img/about__bg.jpg',
                ],
                'contacts' => [
                    [
                        'title'     => 'Завод',
                        'sub_title' => 'Российская Федерация, 662500, Красноярский край, г. Сосновоборск, ул. Заводская, 1 корпус 40',
                        'phone'     => '+7 (391) 256-00-66',
                    ],
                    [
                        'title' => 'Служба качества (звонки по России бесплатные)',
                        'phone' => '+7 (800) 600-59-63',
                        'email' => 'example@dot.com'
                    ],
                    [
                        'title' => 'Отдел оптовых заказов для магазинов и торговых сетей',
                        'phone' => '+7 (391) 256-00-60',
                    ],
                    [
                        'title' => 'Отдел кадров',
                        'phone' => '+7 (913) 567-27-87',
                    ]
                ]

            ],
            'template_id'      => $template->id,
            'essential'        => true,

        ]);
    }

    /**
     * Seed news page data
     *
     * @param $template
     */
    private function seedNews($template)
    {
        Page::create([
            'title'            => 'DELSY NEWS',
            'description'      => 'DELSY NEWS',
            'meta_title'       => 'DELSY NEWS',
            'meta_description' => 'DELSY NEWS',
            'slug'             => \Illuminate\Support\Str::slug('news'),
            'template_id'      => $template->id,
            'essential'        => true,
        ]);
    }


    /**
     * Seed categories page data
     *
     * @param $template
     */
    private function seedCategories($template)
    {
        Page::create([
            'title'            => 'DELSY CATEGORIES',
            'description'      => 'DELSY CATEGORIES',
            'meta_title'       => 'DELSY CATEGORIES',
            'meta_description' => 'DELSY CATEGORIES',
            'slug'             => \Illuminate\Support\Str::slug('categories'),
            'body'             => [
                'product_slider' => [
                    [
                        'title'       => 'Попробуйте вкусные и сочные кальмары',
                        'description' => 'Хачапури, самса, покупаем не стесняемся',
                        'src'         => '/library/public/img/slider-hero-1.png',
                        'url'         => '/',
                    ],
                    [
                        'title'       => 'Попробуйте вкусные и сочные кальмары',
                        'description' => 'Хачапури, самса, покупаем не стесняемся',
                        'src'         => '/library/public/img/slider-hero-1.png',
                        'url'         => '/',

                    ],
                    [
                        'title'       => 'Попробуйте вкусные и сочные кальмары',
                        'description' => 'Хачапури, самса, покупаем не стесняемся',
                        'src'         => '/library/public/img/slider-hero-1.png',
                        'url'         => '/',

                    ],
                ]
            ],
            'template_id'      => $template->id,
            'essential'        => true,
        ]);
    }

    /**
     * @param $template
     */
    public function seedPolicy($template)
    {
        Page::create([
            'title'            => 'DELSY policy',
            'description'      => 'DELSY policy',
            'meta_title'       => 'DELSY policy',
            'meta_description' => 'DELSY policy',
            'slug'             => \Illuminate\Support\Str::slug('policy'),
            'body'             => [
                'html' => '<div><h1>BIG POLICY PAGE</h1> <b>or not really</b></div>'
            ],
            'template_id'      => $template->id,
            'essential'        => true,
        ]);

    }


}
