<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'dummy@email.test'
        ]);

        $this->withoutMiddleware(Authenticate::class);

        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
    }

    /** @test */
    public function user_can_get_list_of_categories()
    {
        $categories = Category::factory(5)->create();

        $response = $this->actingAs($this->user)
                        ->get(route('api.categories.index'));

        $response->assertOk();
        $response->assertJsonFragment([
            'name' => $categories->random()->name
        ]);
    }

    /** @test */
    public function user_can_create_a_category()
    {
        $categoryName = ['name' => $this->faker->word()];

        $response = $this->actingAs($this->user)
                        ->post(route('api.categories.store'), $categoryName);

        $this->assertDatabaseHas('categories', $categoryName);
        $response->assertCreated();
        $response->assertJsonFragment($categoryName);

    }

    /** @test */
    public function user_can_view_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->user)
                        ->get(route('api.categories.show', $category));

        $response->assertOk();
        $response->assertJsonFragment([
            'name' => $category->name
        ]);
    }

    /** @test */
    public function user_can_update_a_category()
    {
        $categoryNameOld = ['name' => $this->faker->word()];
        $categoryNameNew = ['name' => $this->faker->word()];

        $category = $this->user->categories()->create($categoryNameOld);

        $response = $this->actingAs($this->user)
                        ->put(route('api.categories.update', $category), $categoryNameNew);

        $this->assertDatabaseMissing('categories', $categoryNameOld);
        $this->assertDatabaseHas('categories', $categoryNameNew);

        $response->assertOk();
        $response->assertJsonFragment($categoryNameNew);
    }

    /** @test */
    public function user_can_delete_a_category()
    {
        $categoryName = ['name' => $this->faker->word()];

        $category = $this->user->categories()->create($categoryName);

        $response = $this->actingAs($this->user)
                        ->delete(route('api.categories.destroy', $category));

        $this->assertDatabaseMissing('categories', $categoryName);

        $response->assertOk();
    }

}
