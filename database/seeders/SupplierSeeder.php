<?php

namespace Database\Seeders;

// SupplierSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Product; // Ensure Product model is imported

class SupplierSeeder extends Seeder
{
    public function run()
    {
        Supplier::factory(10)->create()->each(function ($supplier) {
            $supplier->products()->saveMany(Product::factory(5)->create(['supplier_id' => $supplier->id]));
        });
    }
}

