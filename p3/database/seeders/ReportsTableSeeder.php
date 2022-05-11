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
        $this->addAllReportsFromReportsDotJsonFile();
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
            $report->observer_last_name = $this->faker->lastName;
            $report->observer_email = $this->faker->safeEmail;
            $report->save();
        }
    }

    /**
     *
     */
    private function addAllReportsFromReportsDotJsonFile()
    {
        $reportData = file_get_contents(database_path('reports.json'));
        $reports = json_decode($reportData, true);

        foreach ($reports as $reportData) {

            $report = new Report();
            $report->created_at = $this->faker->dateTimeThisMonth();
            $report->updated_at = $this->faker->dateTimeThisMonth();
            $report->street_number = $reportData['street_number'];
            $report->street_name = $reportData['street_name'];
            $report->date_observed = $reportData['date_observed'];
            $report->heritage_tree = $reportData['heritage_tree'];
            $report->comments = $reportData['comments'];
            $report->observer_first_name = $this->faker->firstName;
            $report->observer_last_name = $this->faker->lastName;;
            $report->observer_email = $this->faker->safeEmail;
            $report->save();
        }
    }
}