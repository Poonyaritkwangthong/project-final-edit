<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vote') -> insert([
            ['vote' => 'เห็นด้วย'],
            ['vote' => 'ไม่เห็นด้วย'],
           ]); 
    }
}
