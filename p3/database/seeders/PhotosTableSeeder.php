<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Report;
use App\Models\Photo;
use App\Models\Category;
use Faker\Factory;

class PhotosTableSeeder extends Seeder
{
    private $faker;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();

        /**
         * This run method is the first method you should have in all your Seeder class files
         * This method will be invoked when we invoke this seeder
         * In this method you should put code that will cause data to be entered into your tables
         * (in this case, that's the `photos` table)
         */

        # Done primarily for learning purposes
        $this->addRandomlyGeneratedPhotoRecordsUsingFaker();
        $this->addAllPhotosFromPhotosDotJsonFile();
        //$this->addMultiplePhotos();
    }

    private function addMultiplePhotos()
    {
        // Array of report data to add
        $photos = [
            ['2022-05-01_39-56th-Massachusetts-Ave-NW_Broken-branch-2500-Mass.jpeg','Broken branches at 2500 Mass Ave', '3',  ],
        ];
        $count = count($photos);

        # Loop through each author, adding them to the database
        foreach ($photos as $photoData) {
            $photo = new Photo();
            
            $photo->created_at = $this->faker->dateTimeThisMonth();
            $photo->updated_at = $this->faker->dateTimeThisMonth();

            $photo->filename = $photoData[0];
            $photo->caption = $photoData[1];
            $photo->report_id = $photoData[2];
         
            $photo->save();          
            $count--;
        }
    }
    
    private function addRandomlyGeneratedPhotoRecordsUsingFaker()
    {
        for ($i = 1; $i <= 3; $i++) {
            $photo = new photo();
            
            $timestamp = $this->faker->dateTimeThisMonth();

            $photo->created_at = $timestamp;
            $photo->updated_at =  $timestamp;
            $photo->report_id = $i;
            $photo->filename = 'dummy.png';
            $photo->url = "http://e15p3.flyingdog.nu/uploads/" . $photo->filename;
            $photo->caption = $this->faker->catchPhrase();

            $photo->save();
        }

    }

    private function addAllPhotosFromPhotosDotJsonFile()
    {
        $photoData = file_get_contents(database_path('photos.json'));
        $photos = json_decode($photoData, true);

        foreach ($photos as $photoData) {

            $photo = new Photo();
            $photo->created_at = $this->faker->dateTimeThisMonth();
            $photo->updated_at = $this->faker->dateTimeThisMonth();
            $photo->filename = $photoData['filename'];
            $photo->report_id = $photoData['report_id'];

            $photo->caption = $photoData['caption'];
            $photo->url = $photoData['url'];
  
            $photo->save();
        }
    }
}