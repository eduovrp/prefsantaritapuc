<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use \App\Models\Post;
use \App\Models\Festivity;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        Post::factory(10)
        ->hasTags(2)
        ->create();

        Festivity::factory(6)
        ->hasFestivityImages(2)
        ->create();

        Contact::factory(5)->create();

        // Admin Password "admin123"
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'avatar_url' => 'images/others/ninja.png',
            'email' => 'admin@santaritadoeste.sp.gov.br',
            'nivel_acesso_id' => '1',
            'password' => '$2y$10$hRijxsCdf8vr4x7etp5sie9h/O/q4PTLi9vFFV.BHwuKPwjRwfNc.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->call([
            CardSeeder::class,
            FileCategorySeeder::class,
            FileSubCategorySeeder::class,
            FileSeeder::class,
            NivelAcessoSeeder::class
        ]);

    }
}
