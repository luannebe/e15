<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Report;

class CategoryReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addRandomlyGeneratedCategories();
    }

    private function addRandomlyGeneratedCategories()
    {
        # Assign randomly generated categories to all reports 

        $reports = Report::all();

        foreach ($reports as $report) {
            $id_arr = array();
            // create array of three unique randomly selected integers
            while (count($id_arr) < 3) {
                $id = rand(1, 5);
                if (!in_array($id, $id_arr)) {
                    $id_arr[] = $id;
                }
            }
            foreach ( $id_arr as $cat_id) {              
                $category = Category::find($cat_id);
                $report->categories()->save($category);
            }
        }
    }
}