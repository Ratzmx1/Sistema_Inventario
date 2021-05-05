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
        $m = new Models\Role();
        $m->tipo = "ADMIN";
        $m->save();
        Models\Role::factory(6)->create();
        $u = new Models\User();
        $u->email="user@email.com";
        $u->password=bcrypt("12345");
        $u->name="ADMIN";
        $u->lastname="chistoso";
        $u->role_id=1;
        $u->save();
        $u2 = new Models\User();
        $u2->email="user2@email.com";
        $u2->password=bcrypt("12345");
        $u2->name="USER";
        $u2->lastname="Gracioso";
        $u2->role_id=2;
        $u2->save();
//        Models\User::factory(10)->create();
        Models\Category::factory(15)->create();
        Models\Provider::factory(30)->create();
        Models\Subcategory::factory(40)->create();
        Models\Product::factory(150)->create();
        Models\Check_in::factory(5)->create();
        Models\Check_in_detail::factory(5)->create();

    }
}
