<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\EloquentPostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Category\EloquentCategoryRepository;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;
    protected $categories;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->categories = Category::factory(5)->create();

        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
        $this->app->bind(PostRepository::class, EloquentPostRepository::class);
    }


    /** @test */
    public function user_can_view_posts_list()
    {
        $posts = Post::factory(5)->create();

        $response = $this->actingAs($this->user)
                        ->get(route('posts.index'));

        $response->assertOk();
        $response->assertViewHas('posts');
        $response->assertSeeText($posts->random()->title);
    }

    /** @test */
    public function user_can_view_a_post_detail()
    {
        $post = Post::factory()->create();

        $response = $this->actingAs($this->user)
                        ->get(route('posts.show', ['post' => $post]));

        $response->assertOk();
        $response->assertViewHas('post');
        $response->assertSeeText($post->title);
        $response->assertSeeText($post->content);
    }

    /** @test */
    public function user_can_store_a_post()
    {
        $data = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(24),
            'category' => $this->categories->random()->id
        ];

        $response = $this->actingAs($this->user)
                        ->post(route('posts.store'), $data);

        $data['category_id'] = $data['category'];
        unset($data['category']);

        $data['user_id'] = $this->user->id;

        $this->assertDatabaseHas('posts', $data);

        $response->assertRedirect(route('posts.show', ['post' => 1]));
    }

    /** @test */
    public function user_can_update_a_post()
    {
        $oldData = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(24),
            'category' => $this->categories->random()->id
        ];

        $newData = [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(24),
            'category' => $this->categories->random()->id
        ];

        $post = $this->user->posts()->create($oldData);

        $response = $this->actingAs($this->user)
                        ->put(route('posts.update', ['post' => $post]), $newData);

        $oldData['category_id'] = $oldData['category'];
        unset($oldData['category']);

        $newData['category_id'] = $newData['category'];
        unset($newData['category']);

        $this->assertDatabaseMissing('posts', $oldData);
        $this->assertDatabaseHas('posts', $newData);

        $response->assertRedirect(route('posts.show', ['post' => $post]));
    }

    /** @test */
    public function user_can_delete_a_post()
    {
        $post = Post::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)
                        ->delete(route('posts.destroy', ['post' => $post]));

        $this->assertDatabaseMissing('posts', $post->toArray());

        $response->assertRedirect(route('posts.index'));

    }


}
