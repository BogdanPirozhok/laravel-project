<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => false,

    // Categories Database Tables
    'tables' => [

        'categories' => 'categories',
        'categorizables' => 'categorizables',

    ],

    // Categories Models
    'models' => [
        'category' => \App\Repositories\Category\Models\Category::class,
    ],

];
