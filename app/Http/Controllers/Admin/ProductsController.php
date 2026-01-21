<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
     public function index()
    {
        $products = Product::all();
    
        //devolver vista
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        //devolver vista
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'key' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'sometimes|required|numeric|min:0'
        ]);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('products', 'public');
            $validated['imagen'] = $imagePath;
        }

        $product = Product::create($validated);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'key' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'sometimes|required|numeric|min:0'
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            if ($product->imagen) {
                Storage::disk('public')->delete($product->imagen);
            }
            
            $imagePath = $request->file('imagen')->store('products', 'public');
            $validated['imagen'] = $imagePath;
        }

        $product->update($validated);

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Eliminar imagen
        if ($product->imagen) {
            Storage::disk('public')->delete($product->imagen);
        }

        $product->delete();

        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
}
