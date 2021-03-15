<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
            'name' => 'arquivo 1',
            'path' => 'null',
            'year' => 2021,
            'file_category_id' => '1',
            'file_sub_category_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files')->insert([
            'name' => 'arquivo 2',
            'path' => 'null',
            'year' => 2021,
            'file_category_id' => '1',
            'file_sub_category_id' => '2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files')->insert([
            'name' => 'arquivo 3',
            'path' => 'null',
            'year' => 2021,
            'file_category_id' => '2',
            'file_sub_category_id' => '4',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
