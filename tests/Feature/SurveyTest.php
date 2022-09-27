<?php

namespace Tests\Feature;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SurveyTest extends TestCase
{
    public function test_guest_is_redirected_to_login_page_when_tries_to_open_survey_create_page()
    {
        $response = $this->get(route('survey.create'));

        $response->assertStatus(302);
    }

    public function test_guest_is_redirected_to_login_page_when_tries_to_open_survey_index_page()
    {
        $response = $this->get(route('survey.index'));

        $response->assertStatus(302);
    }

    public function test_guest_is_redirected_to_login_page_when_tries_to_open_survey_index_user_surveys_page()
    {
        $response = $this->get(route('survey.index_user_surveys'));

        $response->assertStatus(302);
    }

    public function test_user_can_open_survey_create_page()
    {
        $user = User::factory()->create()->assignRole('user');

        $response = $this->actingAs($user)->get(route('survey.create'));

        $response->assertStatus(200);
    }

    public function test_user_can_store_survey()
    {
        $user = User::factory()->create()->assignRole('user');
        $survey = [
            'title' => "Example title",
            'url_slug' => Str::slug('Example title'),
            'description' => 'Example description',
            'user_id' => $user->id,
        ];

        $response = $this->actingAs($user)
            ->post(route('survey.store'), $survey);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('survey.index_user_surveys'));
    }

    public function test_index_user_surveys_view_works_after_creating_survey()
    {
        $user = User::factory()->create()->assignRole('user');
        $survey = [
            'title' => "Example title",
            'url_slug' => Str::slug('Example title'),
            'description' => 'Example description',
            'user_id' => $user->id,
        ];

        $response = $this->followingRedirects()
            ->actingAs($user)
            ->post(route('survey.store'), $survey);

        $response
            ->assertStatus(200)
            ->assertSeeTextInOrder(['Example title', 'example-title', 'Example description']);
    }
}
