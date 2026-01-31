<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Mostrar lista de productos
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Mostrar formulario de creación de producto
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Mostrar detalles de un producto
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Mostrar formulario de edición de producto
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:255',
            'key' => 'required|string|min:3|max:255|unique:products,key|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'description' => 'required|string|min:10',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $validated['image'] = $request->hasFile('imagen')
            ? $request->file('imagen')->store('products', 'public')
            : null;

        $product = Product::create($validated);

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|min:5|max:255',
            'key' => 'required|string|min:3|max:255|unique:products,key,' . $id . '|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'description' => 'required|string|min:10',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('imagen')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.show', $product->id)
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar producto
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
