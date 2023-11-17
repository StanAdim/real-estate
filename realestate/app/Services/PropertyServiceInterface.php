<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\View\View;

interface PropertyServiceInterface
{
    public function updateProperty(Property $property, $data);
    public function createProperty(array $data);
    public function getPropertiesForUser($userId);
    public function findPropertyOrFail($propertyId);
    public function allProperties(): View;
    public function destroyProperty(Property $property);
}
