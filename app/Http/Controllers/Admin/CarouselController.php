<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    /**
     * Display a listing of carousel items
     */
    public function index()
    {
        $carouselItems = CarouselItem::orderBy('sort_order', 'asc')->get();
        return view('admin.carousel.index', compact('carouselItems'));
    }

    /**
     * Show the form for creating a new carousel item
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created carousel item in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'storage_disk' => 'in:public,s3',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        // Upload image
        $disk = $request->input('storage_disk', 'public');
        $path = $this->uploadImage($request->file('image'), $disk);

        // Create carousel item
        CarouselItem::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'image_path' => $path,
            'storage_disk' => $disk,
            'sort_order' => $validated['sort_order'] ?? CarouselItem::count(),
            'is_active' => true,
        ]);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel item created successfully!');
    }

    /**
     * Show the form for editing the specified carousel item
     */
    public function edit(CarouselItem $carouselItem)
    {
        return view('admin.carousel.edit', compact('carouselItem'));
    }

    /**
     * Update the specified carousel item in storage
     */
    public function update(Request $request, CarouselItem $carouselItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'storage_disk' => 'in:public,s3',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($carouselItem->image_path, $carouselItem->storage_disk);

            // Upload new image
            $disk = $request->input('storage_disk', $carouselItem->storage_disk);
            $path = $this->uploadImage($request->file('image'), $disk);

            $carouselItem->image_path = $path;
            $carouselItem->storage_disk = $disk;
        }

        $carouselItem->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? $carouselItem->subtitle,
            'sort_order' => $validated['sort_order'] ?? $carouselItem->sort_order,
            'is_active' => $validated['is_active'] ?? $carouselItem->is_active,
        ]);

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel item updated successfully!');
    }

    /**
     * Remove the specified carousel item from storage
     */
    public function destroy(CarouselItem $carouselItem)
    {
        // Delete image from storage
        $this->deleteImage($carouselItem->image_path, $carouselItem->storage_disk);

        $carouselItem->delete();

        return redirect()->route('admin.carousel.index')
            ->with('success', 'Carousel item deleted successfully!');
    }

    /**
     * Reorder carousel items
     */
    public function reorder(Request $request)
    {
        $items = $request->input('items', []);

        foreach ($items as $index => $itemId) {
            CarouselItem::where('id', $itemId)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true, 'message' => 'Carousel reordered successfully!']);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(CarouselItem $carouselItem)
    {
        $carouselItem->update(['is_active' => !$carouselItem->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $carouselItem->is_active,
            'message' => $carouselItem->is_active ? 'Item activated' : 'Item deactivated'
        ]);
    }

    /**
     * Upload image to specified disk
     */
    private function uploadImage($file, $disk = 'public')
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('carousel', $filename, $disk);
        return $path;
    }

    /**
     * Delete image from specified disk
     */
    private function deleteImage($path, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
