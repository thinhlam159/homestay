<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

class PropertyRepository implements PropertyRepositoryInterface
{
    public function getAll(): Collection
    {
        return Property::all();
    }

    public function getById(string $id): ?Property
    {
        return Property::find($id);
    }

    public function create(array $data): Property
    {
        return Property::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $property = Property::find($id);
        if ($property) {
            return $property->update($data);
        }
        return false;
    }

    public function delete(string $id): bool
    {
        $property = Property::find($id);
        if ($property) {
            return $property->delete();
        }
        return false;
    }
}
