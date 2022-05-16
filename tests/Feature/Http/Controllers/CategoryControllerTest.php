<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategoryRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->app->bind(CategoryRepository::class, EloquentCategoryRepository::class);
    }

    /** @test */
    public function user_can_view_categories_list()
    {
        Category::factory(5)->create();

        $response = $this->actingAs($this->user)
                        ->get(route('categories.index'));

        $response->assertOk();
        $response->assertViewHas('categories');
        $response->assertSeeText(Category::latest('updated_at')->first()->name);
    }

    /** @test */
    public function user_can_store_a_category()
    {
        $data = [
            'name' => $this->faker->sentence(2)
        ];

        $response = $this->actingAs($this->user)
                        ->post(route('categories.store'), $data);

        $this->assertDatabaseHas('categories', $data);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function user_can_update_a_category()
    {
        $oldData = [
            'name' => $this->faker->sentence(2)
        ];

        $newData = [
            'name' => $this->faker->sentence(2)
        ];

        $category = Category::factory()->create($oldData);

        $response = $this->actingAs($this->user)
                        ->put(route('categories.update', ['category' => $category]), $newData);

        $this->assertDatabaseMissing('categories', $oldData);
        $this->assertDatabaseHas('categories', $newData);

        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function user_can_delete_a_category()
    {
        $category = Category::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)
                        ->delete(route('categories.destroy', ['category' => $category]));

        $this->assertDatabaseMissing('categories', $category->toArray());
        $response->assertRedirect(route('categories.index'));
    }
}
