<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

interface PropertyServiceInterface
{
    public function getAllProperties(): Collection;
    public function getPropertyById(string $id): ?Property;
    public function createProperty(array $data): Property;
    public function updateProperty(string $id, array $data): bool;
    public function deleteProperty(string $id): bool;
    public function getPropertyOwners(); // Method to fetch property owners
}
