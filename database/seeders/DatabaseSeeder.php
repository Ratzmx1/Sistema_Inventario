<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Models\Role::factory(6)->create();
//        Models\User::factory(10)->create();
        Models\Category::factory(15)->create();
        Models\Provider::factory(30)->create();
        Models\Subcategory::factory(40)->create();
        Models\Product::factory(150)->create();

    }
}
