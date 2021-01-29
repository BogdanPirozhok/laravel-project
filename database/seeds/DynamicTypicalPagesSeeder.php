<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class DynamicTypicalPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title'            => 'DELSY WITH HEADER',
            'description'      => 'DELSY WITH HEADER',
            'meta_title'       => 'DELSY WITH HEADER',
            'meta_description' => 'DELSY WITH HEADER',
            'slug'             => \Illuminate\Support\Str::slug('with-head'),
            'body'             => [
                'header' => [
                    'title'     => 'Еда всему голова!',
                    'sub_title' => 'Завтрак, снеки, отдых с друзьями, семейный обед или торжесвенный ужин, в ассортименте Делси легко найдется подходящий вкусный и полезный продукт. Мы всегда стараемся радовать своих покупателей вкусными и полезными новинками.',
                    'image_url' => '/library/public/img/filter-img-1.jpg',
                ],
                'html'   => '<div><h1>With header</h1> <p><b>Hello</b></p></div>'
            ],
            'template_id'      => 1,
            'essential'        => false,
            'is_published'     => true
        ]);

        Page::create([
            'title'            => 'DELSY WITHOUT HEADER',
            'description'      => 'DELSY WITHOUT HEADER',
            'meta_title'       => 'DELSY WITHOUT HEADER',
            'meta_description' => 'DELSY WITHOUT HEADER',
            'slug'             => \Illuminate\Support\Str::slug('without-head'),
            'body'             => [
                'html'   => '<div><h1>Without header</h1> <p><b>Hello</b></p></div>'
            ],
            'template_id'      => 1,
            'essential'        => false,
            'is_published'     => true
        ]);
    }
}
