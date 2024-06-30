<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //function for serach supplier--------------------------------------------------------
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile_numbers', 'like', "%{$search}%");
        }

        $suppliers = $query->with('products')->paginate(20);
        return response()->json($suppliers);
    }

    //func for add supplier--------------------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'mobile_numbers' => 'required|string',
            'products' => 'required|array',
            'products.*.product_name' => 'required|string|max:255',
            'products.*.product_price' => 'required|numeric',
            'products.*.expired_date' => 'required|date',
            'products.*.image' => 'required|string',
        ]);

        $supplier = Supplier::create($request->only(['name', 'contact_person', 'mobile_numbers']));
        $supplier->products()->createMany($validated['products']);

        return response()->json($supplier, 201);
    }

    //function for update supplier--------------------------------------------------------
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'contact_person' => 'sometimes|required|string|max:255',
            'mobile_numbers' => 'sometimes|required|string',
            'products' => 'sometimes|array',
            'products.*.product_name' => 'sometimes|required|string|max:255',
            'products.*.product_price' => 'sometimes|required|numeric',
            'products.*.expired_date' => 'sometimes|required|date',
            'products.*.image' => 'sometimes|required|string',
        ]);

        $supplier->update($request->only(['name', 'contact_person', 'mobile_numbers']));

        if ($request->has('products')) {
            $supplier->products()->delete();
            $supplier->products()->createMany($validated['products']);
        }

        return response()->json($supplier);
    }

    //function for delete supplier--------------------------------------------------------
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(null, 204);
    }
}
