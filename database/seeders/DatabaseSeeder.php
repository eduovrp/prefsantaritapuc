<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Post;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();

        Post::factory(10)
        ->hasTags(2)
        ->hasCategoryPost(1)
        ->create();

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'avatar_url' => 'images/others/ninja.png',
            'email' => 'admin@santaritadoeste.sp.gov.br',
            'nivelAcesso' => 'Admin',
            'password' => '$2y$10$hRijxsCdf8vr4x7etp5sie9h/O/q4PTLi9vFFV.BHwuKPwjRwfNc.'
        ]);

        DB::table('cards')->insert([
            'name'=>'Novembro Azul',
            'src_img'=>'images/cards/novembroazul.png',
            'date_exp'=>'2020-12-31 23:59:59',
        ]);

        DB::table('cards')->insert([
            'name'=>'Natal 2019',
            'src_img'=>'images/cards/natal2019.png',
            'src_img_onclick'=>'images/cards/natal2019_onclick.png',
            'date_exp'=>'2020-12-31 23:59:59',
        ]);
    }
}
