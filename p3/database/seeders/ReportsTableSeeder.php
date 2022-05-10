<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Report;
use App\Models\Photo;
use App\Models\Category;
use Faker\Factory;

class ReportsTableSeeder extends Seeder
{
    private $faker;

    /**
     * This run method is the first method you should have in all your Seeder class files
     * This method will be invoked when we invoke this seeder
     * In this method you should put code that will cause data to be entered into your tables
     * (in this case, that's the `reports` table)
     */
    public function run()
    {
        # https://fakerphp.github.io
        $this->faker = Factory::create();
        $this->addRandomlyGeneratedReportsUsingFaker();
        //$this->addMultipleReports();
    }

    /**
     *
     */
    private function addMultipleReports()
    {
        // Array of report data to add
        $reports = [
            ['2021-05-03', '2500', 'Massachusetts Ave NW', '0', 'The branches of street tree by 2500 Mass were whacked ~2 weeks ago. RMA reported to Miller Pipeline.','Deborah', 'Shapley', 'restoremassave@gmail.com', '3' ],
        ];
        $count = count($reports);

        # Loop through each author, adding them to the database
        foreach ($reports as $reportData) {
            $report = new Report();
            
            $report->created_at = $this->faker->dateTimeThisMonth();
            $report->updated_at = $this->faker->dateTimeThisMonth();

            $report->date_observed = $reportData[0];
            $report->street_number = $reportData[1];
            $report->street_name = $reportData[2];
            $report->heritage_tree = $reportData[3];
            $report->comments = $reportData[4];
            $report->observer_first_name = $reportData[5];
            $report->observer_last_name = $reportData[6];
            $report->observer_email = $reportData[7];
            $report->photo_id = $reportData[8];
            
            $report->save();          
            $count--;
        }
    }

    /**
     * Note: This requires generating same number of photos in Photos Table Seeder.
     * Alternatively, could have set photo_id FK to null
     */
    private function addRandomlyGeneratedReportsUsingFaker()
    {
        for ($i = 1; $i <= 3; $i++) {
            $report = new report();
            
            $timestamp = $this->faker->dateTimeThisMonth();

            $report->created_at = $timestamp;
            $report->updated_at =  $timestamp;

            $report->street_number = $this->faker->numberBetween($min = 1000, $max = 9000);
            $report->street_name = 'Massachusetts Ave. NW';
            $report->date_observed = $this->faker->date($format = 'Y-m-d', $max = 'now');
            $report->heritage_tree = $this->faker->boolean();
            $report->comments = $this->faker->paragraphs(1, true);
            $report->observer_first_name = $this->faker->firstName;
            $report->observer_last_name = $this->faker->lastName;;
            $report->observer_email = $this->faker->safeEmail;
            $report->save();
        }
    }
}