<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersAndProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = [
            [
                'email' => 'user1@email.ru',
                'phone' => '+77083662915',
            ],
            [
                'email' => 'user2@email.ru',
                'phone' => '+77083662915',
            ],
            [
                'email' => 'user3@email.ru',
                'phone' => '+77083662915',
            ],
            [
                'email' => 'user4@email.ru',
                'phone' => '+77083662915',
            ]
        ];

        $products = [
            [
                'name' => 'Burger',
                'price' => 30,
            ],
            [
                'name' => 'Burger 2XL',
                'price' => 45,
            ],
            [
                'name' => 'Cheese-Burger',
                'price' => 35,
            ],
            [
                'name' => 'Cheese-Burger 2XL',
                'price' => 50,
            ],
            [
                'name' => 'Hamburger',
                'price' => 45,
            ],
            [
                'name' => 'Hamburger 2XL',
                'price' => 60,
            ],
            [
                'name' => 'Pizza',
                'price' => 35,
            ],
            [
                'name' => 'Pizza 2XL',
                'price' => 50,
            ],
            [
                'name' => 'Cofee',
                'price' => 10,
            ],
            [
                'name' => 'Toast',
                'price' => 25,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'phone' => $user['phone'],
            ]);
        }

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name'  => $product['name'],
                'price' => $product['price'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
        DB::table('products')->truncate();
    }
}
