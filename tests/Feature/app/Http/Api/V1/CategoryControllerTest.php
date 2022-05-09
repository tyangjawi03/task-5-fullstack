<?php

namespace Tests\Feature\app\Http\Api\V1;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
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

        $this->withoutMiddleware();
    }

    /** @test */
    public function user_can_get_list_of_categories()
    {
        $categories = Category::factory(5)->create();

        $response = $this->actingAs($this->user)
                        ->get(route('categories.index'));

        $response->assertOk();
        $response->assertJsonFragment([
            'name' => $categories->random()->name
        ]);
    }

}
