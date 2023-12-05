<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);
        //Genre
        \App\Models\Genere::create([
            'name' => '休暇'
        ]);
        \App\Models\Genere::create([
            'name' => '評価'
        ]);
        //Rule
        \App\Models\Rule::create([
            'name' => '育休',
            'description' => '大事なこと',
            'genere_id' => '1'
        ]);
        \App\Models\Rule::create([
            'name' => '産休',
            'description' => 'これも大事',
            'genere_id' => '1'
        ]);
        \App\Models\Rule::create([
            'name' => 'アルバイト',
            'description' => '最低賃金の改正に対応',
            'genere_id' => '2'
        ]);
        \App\Models\Document::create([
            'rule_id' => '1',
            'user_id' => '1',
            'enactment_date' => '2021-10-31',
            'note' => 'yahooのホームページ',
            'path' => 'https://www.yahoo.co.jp/'
        ]);
        \App\Models\Document::create([
            'rule_id' => '1',
            'user_id' => '1',
            'enactment_date' => '2021-10-31',
            'note' => '九大のホームページ',
            'path' => 'https://www.kyushu-u.ac.jp/ja/'
        ]);
    }
}
