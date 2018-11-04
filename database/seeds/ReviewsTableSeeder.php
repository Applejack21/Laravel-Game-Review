<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert(['review_title' => 'Crash Team Racing Review', 'review_by' => 'George', 'game_title' => 'Crash Team Racing', 'review_desc' => 'It\'s a good game', 'review_rating' => '5']);
    }
}