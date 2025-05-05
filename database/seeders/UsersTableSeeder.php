<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['over_name' => '澤田'],
            ['under_name' => '祐紀'],
            ['over_name_kana' => 'サワダ'],
            ['under_name_kana' => 'ユウキ'],
            ['mail_address' => 'sawada0123@email.com'],
            ['sex' => '1'],
            ['birth_day' => '2001-03-18'],
            ['role' => '4'],
            ['password' => 'sawada0000pw'],
        ]);
    }
}
