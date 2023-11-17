<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\PropertyServiceInterface;

class PropertyService implements PropertyServiceInterface
{
    public function updateProperty(Property $property, $data)
    {
        return $property->update($data);
    }

    public function createProperty(array $data)
    {
        try {
            // Process and save the uploaded image files to storage
            if (request()->hasFile('files')) {
                $images = [];

                foreach (request()->file('files') as $image) {
                    $path = $image->store('images', 'public');// Store image in the 'images' directory within your storage
                    // Extract the file name from the path
                    $fileName = basename($path);
                    // Store the file name in the array for later use
                    $images[] = $fileName;
                }

                // Create a new record in the database, including the 'files' field
                return  Property::create([
                    'name' => $data['name'],
                    'user_id' => Auth::id(),
                    'location' => $data['location'],
                    'price' => $data['price'],
                    'is_available' => $data['is_available'] ?? 0,
                    'description' => $data['description'],
                    'files' => $images,
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getPropertiesForUser($userId)
    {
        return Property::where('user_id', $userId)->get();
    }
    public function findPropertyOrFail($propertyId)
    {
        return Property::findOrFail($propertyId);
    }
    public function allProperties(): View
    {
        try {
            $properties = Property::all();

            return view('home.components.backend.grid-property', ['properties' => $properties]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroyProperty(Property $property)
    {
        try {
            // Get the image file paths from the 'files' column (assuming it's already an array)
            $imagePaths = $property->files;

            // Delete the associated image files from storage
            foreach ($imagePaths as $imagePath) {
                Log::info("Deleting image: $imagePath");
                Storage::disk('public')->delete("images/$imagePath");
            }

            // Delete the property
            $property->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
