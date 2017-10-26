<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_number')->unique();
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->string('fa_icon');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->string('name');
            $table->string('display_name');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('categories');
            $table->integer('sub_category_id')->references('id')->on('sub_categories');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->string('brand');
            $table->integer('original_price');
            $table->text('description_text');
            $table->string('description_image_url');
            $table->string('description_video_url');
            $table->boolean('is_featured');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('seller_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->integer('seller_id')->references('id')->on('users');
            $table->integer('seller_price');
            $table->integer('delivery_charge');
            $table->boolean('is_in_stock');
            $table->boolean('is_cod_available');
            $table->boolean('is_online_payment_available');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_product_id')->references('id')->on('seller_products');
            $table->integer('attribute_id')->references('id')->on('attributes');
            $table->string('value');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->references('id')->on('users');
            $table->integer('product_id')->references('id')->on('products');
            $table->integer('seller_product_id')->references('id')->on('seller_products');
            $table->text('extra');
            $table->integer('count');
            $table->integer('price');
            $table->integer('delivery_charge');
            $table->integer('total_amount');
            $table->string('payment_method');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('order_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->references('id')->on('users');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->references('id')->on('products');
            $table->string('url');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->references('id')->on('users');
            $table->integer('product_id')->references('id')->on('products');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('home_slides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image_url');
            $table->string('link_url');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('city_town');
            $table->string('state');
            $table->string('pin_code');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image_url');
            $table->string('link_url');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        Schema::create('gift_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('value');
            $table->string('type');
            $table->integer('max_amount');
            $table->date('end_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_coupons');
        Schema::dropIfExists('offers');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('home_slides');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('order_logs');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('attribute_values');
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('seller_products');
        Schema::dropIfExists('products');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
}
