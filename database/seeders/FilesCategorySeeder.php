<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FilesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files_categories')->insert([
            'name' => 'Legislação',
            'iconMenu' => 'fas fa-balance-scale',
            'href' => 'legislacao',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_categories')->insert([
            'name' => 'Licitação',
            'iconMenu' => 'fa fa-gavel',
            'href' => 'licitacao',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('files_categories')->insert([
            'name' => 'Concursos Públicos',
            'iconMenu' => 'fas fa-spell-check',
            'href' => 'concursos',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
