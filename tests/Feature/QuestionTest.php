<?php

namespace Tests\Feature;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    public function test_guest_is_redirected_to_login_page_when_tries_to_open_queston_create_page()
    {
        $response = $this->get(route('question.create'));

        $response->assertStatus(302);
    }

    public function test_user_can_open_question_create_page()
    {
        $user = User::factory()->create()->assignRole('user');
        $survey = Survey::factory()->create([
            'title' => "Example title",
            'url_slug' => Str::slug('Example title'),
            'description' => 'Example description',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('question.create', ['surveyId' => $survey->id]));

        $response->assertStatus(200);
    }


    public function test_user_can_store_question()
    {
        $user = User::factory()->create()->assignRole('user');
        $survey = Survey::factory()->create([
            'title' => "Example title",
            'url_slug' => Str::slug('Example title'),
            'description' => 'Example description',
            'user_id' => $user->id,
        ]);

        $question = [
            'title' => "Question title",
            'is_open_question' => true,
            'is_yes_no_question' => false,
            'survey_id' => $survey->id,
        ];

        $response = $this->followingRedirects()->actingAs($user)
            ->post(route('question.store'), $question);

        $response
            ->assertStatus(200);
    }
}
