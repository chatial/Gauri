<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard-admin.product.index',[
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validateData = $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'nama' => 'required',
            'harga' => 'required',
            'detail' => 'required|max:1000'
        ]);

        if ($request->file('gambar')) {
            $validateData['gambar'] = $request->file('gambar')->store('product-images');
        }

        Product::create($validateData);

        alert()->success('Success', 'Produk Berhasil ditambahkan');
        return redirect('/admin-product')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard-admin.product.show',[
            'products' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard-admin.product.edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {   
        try {
            $rules = [
                'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
                'nama' => 'required',
                'harga' => 'required',
                'detail' => 'required|max:1000'
            ];
        
            $validateData = $request->validate($rules);
        
            // Simpan path gambar lama
            $oldImagePath = $product->gambar;
        
            if ($request->file('gambar')) {
                // Hapus gambar lama
                if ($oldImagePath) {
                    Storage::delete($oldImagePath);
                }
        
                // Simpan gambar baru
                $validateData['gambar'] = $request->file('gambar')->store('product-images');
            } else {
                // Hapus aturan validasi gambar jika tidak ada gambar baru yang diunggah
                unset($validateData['gambar']);
            }
        
            $product->update($validateData);
        
            alert()->success('Success', 'Produk Berhasil diupdate');
            return redirect('/admin-product')->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->gambar){
            Storage::delete($product->gambar);
        }

        Product::destroy ($product->id);

        alert()->success('Success', 'Produk Berhasil dihapus');
        return redirect('/admin-product')->withInput();
    }
}
