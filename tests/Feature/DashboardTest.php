<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_its_content_inside_the_app_layout(): void
    {
        $category = Category::create(['name' => 'Analgesics']);
        $brand = Brand::create(['name' => 'Generic']);

        Product::create([
            'sku' => 'MED-PAR-001',
            'name' => 'Paracetamol 500mg',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'quantity' => 100,
            'reorder_level' => 10,
            'unit_price' => 5.00,
        ]);

        $user = User::factory()->create(['email_verified_at' => now()]);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertDontSee('+ Add Product')
            ->assertSee('Total Products')
            ->assertSee('Paracetamol 500mg')
            ->assertSee('Brands')
            ->assertSee('Categories')
            ->assertSee(route('brands.index'))
            ->assertSee(route('categories.index'))
            ->assertSee(route('users.index'));
    }

    public function test_reports_page_is_available(): void
    {
        $category = Category::create(['name' => 'Analgesics']);
        $brand = Brand::create(['name' => 'Generic']);

        Product::create([
            'sku' => 'MED-PAR-001',
            'name' => 'Paracetamol 500mg',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'quantity' => 5,
            'reorder_level' => 10,
            'unit_price' => 5.00,
        ]);

        $this->actingAs(User::factory()->create(['email_verified_at' => now()]))
            ->get(route('reports.index'))
            ->assertOk()
            ->assertSee('Inventory Reports')
            ->assertSee('Low Stock Alert');
    }
}
