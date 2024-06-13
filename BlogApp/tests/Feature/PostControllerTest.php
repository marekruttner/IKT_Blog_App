<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_oldest_post_on_the_second_page_when_there_are_16_posts()
    {
        // Create a user
        $user = User::factory()->create();

        // Create 16 posts
        $posts = Post::factory()->count(16)->create(['user_id' => $user->id]);

        // Act as the user
        $this->actingAs($user);

        // Make a request to the first page of the index route
        $responsePage1 = $this->get(route('posts.index'));

        // Assert the response status is 200 (OK)
        $responsePage1->assertStatus(200);

        // Assert the first page has 15 posts
        $responsePage1->assertViewHas('posts', function ($posts) {
            return $posts->count() == 15;
        });

        // Get the titles of the posts displayed on the first page
        $titlesOnPage1 = $posts->slice(0, 15)->pluck('title')->toArray();

        // Check that each post title on the first page is visible
        foreach ($titlesOnPage1 as $title) {
            $responsePage1->assertSee($title);
        }

        // Make a request to the second page of the index route
        $responsePage2 = $this->get(route('posts.index', ['page' => 2]));

        // Assert the response status is 200 (OK)
        $responsePage2->assertStatus(200);

        // Assert the second page has 1 post
        $responsePage2->assertViewHas('posts', function ($posts) {
            return $posts->count() == 1;
        });

        // Get the title of the post displayed on the second page
        $titleOnPage2 = $posts->last()->title;

        // Check that the post title on the second page is visible
        $responsePage2->assertSee($titleOnPage2);
    }
}
