<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PageAndTemplatesSeeder::class,
            FakeUsersSeeder::class,
            MenuSeeder::class,
            CategorySeeder::class,
            RecipesSeeder::class,
            TagSeeder::class,
            ProductPackageSeeder::class,
            QualityFeedbackSeeder::class,
            PostSeeder::class,
            PointSeeder::class,
            StoreNetworkSeeder::class,
            CatalogRequestSeeder::class,
            ContactRequestSeeder::class,
            TenderAndPurchasesSeeder::class,
            TenderRequestSeeder::class,
            VacancySeeder::class,
            VacancyInquirerSeeder::class,
            ManagerMailingListSeeder::class,
            ProductSeeder::class,
            DynamicTypicalPagesSeeder::class,
        ]);
    }
}
