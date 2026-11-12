<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_inventory_page_displays_products(): void
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

        $response = $this
            ->actingAs(User::factory()->create())
            ->get(route('products.index'));

        $response
            ->assertOk()
            ->assertSee('Inventory List')
            ->assertSee('MED-PAR-001')
            ->assertSee('Paracetamol 500mg')
            ->assertSee('Analgesics')
            ->assertSee('Generic');
    }

    public function test_product_detail_page_renders_without_errors(): void
    {
        $category = Category::create(['name' => 'Analgesics']);
        $brand = Brand::create(['name' => 'Generic']);
        $product = Product::create([
            'sku' => 'MED-PAR-001',
            'name' => 'Paracetamol 500mg',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'quantity' => 100,
            'reorder_level' => 10,
            'unit_price' => 5.00,
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('products.show', $product))
            ->assertOk()
            ->assertSee('Product Details')
            ->assertSee('Unit Price')
            ->assertSee('₱5.00');
    }

    public function test_product_can_be_edited_with_a_description(): void
    {
        $category = Category::create(['name' => 'Analgesics']);
        $brand = Brand::create(['name' => 'Generic']);
        $product = Product::create([
            'sku' => 'MED-PAR-001',
            'name' => 'Paracetamol 500mg',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'quantity' => 100,
            'reorder_level' => 10,
            'unit_price' => 5.00,
        ]);
        $user = User::factory()->create(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->get(route('products.edit', $product))
            ->assertOk()
            ->assertSee('Edit Product');

        $this->actingAs($user)
            ->put(route('products.update', $product), [
                'sku' => 'MED-PAR-001',
                'name' => 'Paracetamol 500mg',
                'description' => 'For pain and fever',
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'quantity' => 100,
                'reorder_level' => 10,
                'unit_price' => 5.00,
            ])
            ->assertRedirect(route('products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'description' => 'For pain and fever',
        ]);
    }
}
