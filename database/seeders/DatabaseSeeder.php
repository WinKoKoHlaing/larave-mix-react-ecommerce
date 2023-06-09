<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'userone',
            'email' => 'userone@gmail.com',
            'phone' => '09332223221',
            'password' => Hash::make('password'),
            'image' => 'default.jpg',
            'address' => 'pathein'
        ]);

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // category
        $categories = ['Clothes','Phones','Shoes','Funitures','Electronics'];
        foreach($categories as $c){
            Category::create([
                'slug' => Str::slug($c),
                'name' => $c,
                'mm_name' => 'အငတ်အစား',
                'image' => 'clothes.jpg'
            ]);
        }

        // brand
        $brands = ['Gucci','Huawei','Nike','Alibaba','Meta'];
        foreach($brands as $b){
            Brand::create([
                'slug' => Str::slug($b),
                'name' => $b,
            ]);
        }

        // color
        $colors = ['white','red','green','black'];
        foreach($colors as $c){
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }

        // supplier
        Supplier::create([
            'name' => 'mgmg',
            'image' => 'mgmg.png',
        ]);
    }
}
