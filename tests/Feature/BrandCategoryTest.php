<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_brands_and_categories_with_descriptions_can_be_saved(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->post(route('brands.store'), [
                'name' => 'Acme',
                'description' => 'Brand description',
            ])
            ->assertRedirect(route('brands.index'));

        $this->actingAs($user)
            ->post(route('categories.store'), [
                'name' => 'Equipment',
                'description' => 'Category description',
            ])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('brands', [
            'name' => 'Acme',
            'description' => 'Brand description',
        ]);
        $this->assertDatabaseHas('categories', [
            'name' => 'Equipment',
            'description' => 'Category description',
        ]);
        $this->assertSame('Brand description', Brand::where('name', 'Acme')->value('description'));
        $this->assertSame('Category description', Category::where('name', 'Equipment')->value('description'));
    }

    public function test_category_can_be_edited(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $category = Category::create([
            'name' => 'Old Category',
            'description' => 'Old description',
        ]);

        $this->actingAs($user)
            ->get(route('categories.edit', $category))
            ->assertOk()
            ->assertSee('Edit Category')
            ->assertSee('Old Category')
            ->assertSee('Old description');

        $this->actingAs($user)
            ->put(route('categories.update', $category), [
                'name' => 'Updated Category',
                'description' => 'Updated description',
            ])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
            'description' => 'Updated description',
        ]);
    }
}
