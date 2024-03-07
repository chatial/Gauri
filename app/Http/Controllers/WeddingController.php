<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreWeddingRequest;
use App\Http\Requests\UpdateWeddingRequest;

class WeddingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard-admin.wedding.index',[
            'weddings' => Wedding::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin.wedding.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWeddingRequest $request)
    {
        $validatedData = $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'nama' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
            'detail' => 'required|max:1000',
            'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        // Upload thumbnail
        if ($request->file('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-images');
        }

        // Create wedding
        $wedding = Wedding::create($validatedData);

        // Upload gallery photos
        $galleryPhotos = $request->file('gallery_photos');

        if ($galleryPhotos) {
            foreach ($galleryPhotos as $galleryPhoto) {
                $galleryPath = $galleryPhoto->store('gallery-images');
                $wedding->galleryPhotos()->create(['photo_path' => $galleryPath]);
            }
        }

        alert()->success('Success', 'Wedding Berhasil ditambahkan');
        return redirect('/admin-wedding')->withInput();
    }



    /**
     * Display the specified resource.
     */
    public function show(Wedding $wedding)
    {
        return view('dashboard-admin.wedding.show',[
            'weddings' => $wedding,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wedding $wedding)
    {
        return view('dashboard-admin.wedding.edit',[
            'wedding' => $wedding,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWeddingRequest $request, Wedding $wedding)
    {
        try {
            $rules = [
                'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
                'nama' => 'required',
                'tanggal' => 'required',
                'tempat' => 'required',
                'detail' => 'required|max:1000',
                'gallery_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
            ];
    
            $validateData = $request->validate($rules);
    
            // Simpan path thumbnail lama
            $oldThumbnailPath = $wedding->thumbnail;
    
            if ($request->file('thumbnail')) {
                // Hapus thumbnail lama
                if ($oldThumbnailPath) {
                    Storage::delete($oldThumbnailPath);
                }
    
                // Simpan thumbnail baru
                $validateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail-images');
            } else {
                // Hapus aturan validasi thumbnail jika tidak ada thumbnail baru yang diunggah
                unset($validateData['thumbnail']);
            }
    
            // Jika ada perubahan pada galeri foto
            if ($request->hasFile('gallery_photos')) {
                // Simpan path gallery photos lama
                $oldGalleryPaths = $wedding->galleryPhotos()->pluck('photo_path')->toArray();
    
                // Handle gallery photos baru
                $galleryPhotos = $request->file('gallery_photos');
                $galleryPaths = [];
    
                foreach ($galleryPhotos as $galleryPhoto) {
                    $galleryPath = $galleryPhoto->store('gallery-images');
                    $galleryPaths[] = ['photo_path' => $galleryPath];
                }
    
                // Hapus gallery photos lama dari storage dan database
                foreach ($oldGalleryPaths as $oldGalleryPath) {
                    Storage::delete($oldGalleryPath);
                }
    
                // Simpan yang baru jika ada
                $wedding->galleryPhotos()->delete(); // Hapus dulu yang ada di database
                $wedding->galleryPhotos()->createMany($galleryPaths);
            }
    
            // Update wedding data
            $wedding->update($validateData);
    
            alert()->success('Success', 'Wedding Berhasil diupdate');
            return redirect('/admin-wedding')->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wedding $wedding)
    {
        // Hapus thumbnail
        if ($wedding->thumbnail) {
            Storage::delete($wedding->thumbnail);
        }

        // Hapus galeri foto yang terkait dan file-filenya
        $galleryPhotos = $wedding->galleryPhotos;

        foreach ($galleryPhotos as $galleryPhoto) {
            if ($galleryPhoto->photo_path) {
                Storage::delete($galleryPhoto->photo_path);
            }
        }

        // Hapus galeri foto yang terkait dari database
        $wedding->galleryPhotos()->delete();

        // Hapus wedding
        $wedding->delete();

        alert()->success('Success', 'Wedding Berhasil dihapus');
        return redirect('/admin-wedding')->withInput();
    }
}
