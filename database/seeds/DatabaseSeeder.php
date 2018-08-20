<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(ChaptersTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(DevicesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(NewsHeadingTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(SubChaptersTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(PhotoResultsTableSeeder::class);
    }
}
