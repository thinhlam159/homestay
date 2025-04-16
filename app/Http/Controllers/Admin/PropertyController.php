<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FileServiceInterface;
use App\Services\PropertyServiceInterface;
use App\Services\CategoryServiceInterface; // Import Category Service
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    protected PropertyServiceInterface $propertyService;
    protected CategoryServiceInterface $categoryService; // Inject Category Service

    public function __construct(
        PropertyServiceInterface $propertyService,
        CategoryServiceInterface $categoryService,
        FileServiceInterface $fileService
    )
    {
        $this->propertyService = $propertyService;
        $this->categoryService = $categoryService; // Initialize Category Service
        $this->fileService = $fileService;
    }

    public function index()
    {
        $properties = $this->propertyService->getAllProperties();
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $propertyOwners = $this->propertyService->getPropertyOwners(); // Get property owners
        $categories = $this->categoryService->getAllCategories(); // Get all categories
        return view('admin.properties.create', compact('propertyOwners', 'categories')); // Pass to view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_id' => 'nullable|string|max:26|exists:users,id', // Validate owner_id
            'category_id' => 'nullable|string|max:26|exists:categories,id', // Validate category_id
            'name' => 'required|string|max:255',
            'property_type' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'images' => 'nullable|array', // Validate images as array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image in the array
            'videos' => 'nullable|json',
            'rule' => 'nullable|string',
            'service' => 'nullable|json',
            'amenities' => 'nullable|json',
            'room_quantity' => 'nullable|integer',
            'standard_people_quantity' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_popular' => 'nullable|boolean',
            'is_discounted' => 'nullable|boolean',
            'checkin_time' => 'nullable|date_format:H:i',
            'checkout_time' => 'nullable|date_format:H:i',
            'deposit_percentage' => 'nullable|numeric|min:0|max:100',
            'cancellation_policy' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $propertyData = $request->except('images'); // Exclude images from property data initially
        $imagePaths = [];

        if ($request->hasFile('images')) { // Check if images were uploaded
            foreach ($request->file('images') as $image) {
                $uploadedFile = $this->fileService->uploadFile($image, 'uploads/property_images'); // Upload each image
                $imagePaths[] = $uploadedFile->file_path; // Store file path
            }
            $propertyData['images'] = json_encode($imagePaths); // Encode image paths to JSON
        } else {
            $propertyData['images'] = json_encode([]); // Store empty array as JSON if no images uploaded
        }

        $this->propertyService->createProperty($propertyData);
        return redirect()->route('admin.properties.index')->with('success', 'Homestay đã được tạo thành công.');
    }

    public function edit(string $id)
    {
        $property = $this->propertyService->getPropertyById($id);
        if (!$property) {
            return redirect()->route('admin.properties.index')->with('error', 'Không tìm thấy homestay.');
        }
        $propertyOwners = $this->propertyService->getPropertyOwners(); // Get property owners
        $categories = $this->categoryService->getAllCategories(); // Get all categories
        return view('admin.properties.edit', compact('property', 'propertyOwners', 'categories')); // Pass to view
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'owner_id' => 'nullable|string|max:26|exists:users,id', // Validate owner_id
            'category_id' => 'nullable|string|max:26|exists:categories,id', // Validate category_id
            'name' => 'required|string|max:255',
            'property_type' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'images' => 'nullable|array', // Validate images as array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image in the array
            'videos' => 'nullable|json',
            'rule' => 'nullable|string',
            'service' => 'nullable|json',
            'amenities' => 'nullable|json',
            'room_quantity' => 'nullable|integer',
            'standard_people_quantity' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'is_popular' => 'nullable|boolean',
            'is_discounted' => 'nullable|boolean',
            'checkin_time' => 'nullable|date_format:H:i',
            'checkout_time' => 'nullable|date_format:H:i',
            'deposit_percentage' => 'nullable|numeric|min:0|max:100',
            'cancellation_policy' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $propertyData = $request->except('images'); // Exclude images from property data initially
        $imagePaths = [];
        $existingProperty = $this->propertyService->getPropertyById($id);
        $existingImages = json_decode($existingProperty->images ?? '[]'); // Get existing images, default to empty array

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $uploadedFile = $this->fileService->uploadFile($image, 'uploads/property_images');
                $imagePaths[] = $uploadedFile->file_path;
            }
        }
        $propertyData['images'] = json_encode(array_merge($existingImages, $imagePaths)); // Merge existing and new images and encode to JSON

        if (!$this->propertyService->updateProperty($id, $propertyData)) {
            return redirect()->route('admin.properties.index')->with('error', 'Không thể cập nhật homestay.');
        }
        return redirect()->route('admin.properties.index')->with('success', 'Homestay đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        if (!$this->propertyService->deleteProperty($id)) {
            return redirect()->route('admin.properties.index')->with('error', 'Không thể xóa homestay.');
        }
        return redirect()->route('admin.properties.index')->with('success', 'Homestay đã được xóa thành công.');
    }
}
