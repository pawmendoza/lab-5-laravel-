<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    


    public function run(): void
    {
         
        User::firstOrCreate(
            ['email' => 'pawigs441@gmail.com'],
            [
                'name' => 'ALMEN',
                'password' => Hash::make('password123'),
            ]
        );

         
        $products = [
            ['sku' => 'MED-AMX-001', 'name' => 'Amoxicillin 500mg', 'category' => 'Antibiotics', 'brand' => 'Generic', 'quantity' => 150, 'reorder_level' => 25, 'price' => 12.50],
            ['sku' => 'MED-LIS-002', 'name' => 'Lisinopril 10mg', 'category' => 'Cardiovascular', 'brand' => 'Generic', 'quantity' => 4, 'reorder_level' => 10, 'price' => 8.00],
            ['sku' => 'MED-PAR-003', 'name' => 'Paracetamol 500mg', 'category' => 'Analgesics', 'brand' => 'Generic', 'quantity' => 300, 'reorder_level' => 25, 'price' => 5.00],
            ['sku' => 'MED-MET-004', 'name' => 'Metformin 850mg', 'category' => 'Antidiabetic', 'brand' => 'Generic', 'quantity' => 3, 'reorder_level' => 10, 'price' => 15.00],
            ['sku' => 'MED-IBU-005', 'name' => 'Ibuprofen 400mg', 'category' => 'Analgesics', 'brand' => 'Generic', 'quantity' => 80, 'reorder_level' => 15, 'price' => 7.50],
             
        ];

        foreach ($products as $item) {
             
            $category = Category::firstOrCreate(['name' => $item['category']]);
            
             
            $brandName = $item['brand'] ?? 'Generic';
            $brand = Brand::firstOrCreate(['name' => $brandName]);

             
            Product::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'name' => $item['name'],
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'quantity' => $item['quantity'],
                    'reorder_level' => $item['reorder_level'],
                    'unit_price' => $item['price'],
                    'cost_price' => $item['price'] * 0.75,  
                ]
            );
        }
    }
}