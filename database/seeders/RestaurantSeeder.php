<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $restaurants = ['testy treat', 'unimart', 'pizza roma', 'pizza hut', 'bella italia', 'north end', 'tabaq', 'peyala', 'Burger king', 'take out', 'kfc', 'salman\'s kitchen', 'kacchi bhai', 'glazed', 'star kabab', 'dhanshiri'];
        foreach($restaurants as $restaurant){
            DB::table('restaurants')->insert([
                'name' => $restaurant,
                'created_at' => date("Y-m-d H:i:s")
            ]);
        }

    }
}
