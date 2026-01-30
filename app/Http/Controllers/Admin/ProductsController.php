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
        $products = Product::paginate(6);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:products,key',
            'description' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0'
        ]);

        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('products', 'public');
            $validated['imagen'] = $imagePath;
        }

        $product = Product::create($validated);

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('success', 'Producto creado exitosamente');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:products,key,' . $id,
            'description' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0'
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

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Eliminar imagen
        if ($product->imagen) {
            Storage::disk('public')->delete($product->imagen);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
