<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
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
        $this->addCategories();
    }

    private function addCategories() {

        $categories = array(
            "Fence around tree wrong size, absent or damaged",
            "Crew is excavating under/near trees",
            "Danger to roots larger than 2 inches in diameter",
            "Branches cut or broken",
            "Other"
        );

        foreach ($categories as $cat) {
            $category = new category();

            $category->created_at = $this->faker->dateTimeThisMonth();
            $category->updated_at = $this->faker->dateTimeThisMonth();
    
            $category->label = $cat;

            $category->save();
        }

    }
}