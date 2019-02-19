<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Адмнистратор',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin111'),
        ]);
        
        DB::table('authors')->insert([
            'FIO' => 'Иванов Иван Иванович'
        ]);

        DB::table('authors')->insert([
            'FIO' => 'Петров Петр Петрович'
        ]);
        
        DB::table('authors')->insert([
            'FIO' => 'Сидоров Сидр Сидорович'
        ]);

        DB::table('books')->insert([
            'name' => 'Первая Книга Иванова',
            'price' => 100.15,
            'author_id' => 1
        ]);

        DB::table('books')->insert([
            'name' => 'Вторая Книга Иванова',
            'price' => 105.15,
            'author_id' => 1
        ]);

        DB::table('books')->insert([
            'name' => 'Первая Книга Петрова',
            'price' => 19,
            'author_id' => 2
        ]);
       
    }
}
