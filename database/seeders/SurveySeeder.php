<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 52; $i++) {
            $randomNumber = fake()->numberBetween(1, 4);

            Survey::factory($randomNumber)
                ->create([
                    'user_id' => $i,
                ]);
        }
    }
}
