<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $adminRole = Role::create([
        	'name' => 'admin',
        	'display_name' => 'Administrator',
        	'description' => 'All access'
        ]);

    	$admin = User::create([
            'type' => 'admin',
    		'name' => 'Administrator',
    		'email' => 'admin@gbmart.in',
    		'password' => bcrypt('admin@123'),
    		'mobile_number' => '9876543210',
    		'status' => 'ACTIVE'
    	]);

    	$admin->attachRole($adminRole);

        $sellerRole = Role::create([
            'name' => 'seller',
            'display_name' => 'Seller',
            'description' => 'All access'
        ]);

        $seller = User::create([
            'type' => 'seller',
            'name' => 'GBMart Seller',
            'email' => 'seller@gbmart.in',
            'password' => bcrypt('seller@123'),
            'mobile_number' => '9876543211',
            'status' => 'ACTIVE'
        ]);

        $seller->attachRole($sellerRole);

        Category::create([ 'name' => 'electronics', 'display_name' => 'Electronics', 'fa_icon' => 'fa-laptop', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'appliances', 'display_name' => 'Appliances', 'fa_icon' => 'fa-wrench', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'men', 'display_name' => 'Men', 'fa_icon' => 'fa-male', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'women', 'display_name' => 'Women', 'fa_icon' => 'fa-female', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'baby-and-kids', 'display_name' => 'Baby & Kids', 'fa_icon' => 'fa-paper-plane', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'home-and-furniture', 'display_name' => 'Home & Furniture', 'fa_icon' => 'fa-home', 'status' => 'ACTIVE' ]);
        Category::create([ 'name' => 'books-and-more', 'display_name' => 'Books & More', 'fa_icon' => 'fa-book', 'status' => 'ACTIVE' ]);
    }
}
