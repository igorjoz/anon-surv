<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $surveyId = fake()->numberBetween(1, 50);
        $randomBoolean = fake()->boolean();

        $isOpenQuestion = $randomBoolean;
        $isYesNoQuestion = !$randomBoolean;

        return [
            'title' => fake()->sentence(),
            'survey_id' => $surveyId,
            'is_open_question' => $isOpenQuestion,
            'is_yes_no_question' => $isYesNoQuestion,
        ];
    }
}
