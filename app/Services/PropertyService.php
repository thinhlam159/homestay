<?php

namespace App\Services;

use App\Models\Property;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\RoleRepositoryInterface; // Import Role Repository
use Illuminate\Database\Eloquent\Collection;

class PropertyService implements PropertyServiceInterface
{
    protected PropertyRepositoryInterface $propertyRepository;
    protected RoleRepositoryInterface $roleRepository; // Inject Role Repository

    public function __construct(PropertyRepositoryInterface $propertyRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->propertyRepository = $propertyRepository;
        $this->roleRepository = $roleRepository; // Initialize Role Repository
    }

    public function getAllProperties(): Collection
    {
        return $this->propertyRepository->getAll();
    }

    public function getPropertyById(string $id): ?Property
    {
        return $this->propertyRepository->getById($id);
    }

    public function createProperty(array $data): Property
    {
        return $this->propertyRepository->create($data);
    }

    public function updateProperty(string $id, array $data): bool
    {
        return $this->propertyRepository->update($id, $data);
    }

    public function deleteProperty(string $id): bool
    {
        return $this->propertyRepository->delete($id);
    }

    public function getPropertyOwners()
    {
        $propertyOwnerRole = $this->roleRepository->findBySlug('property-owner');
        if ($propertyOwnerRole) {
            return $propertyOwnerRole->users; // Get users with 'property-owner' role
        }
        return collect(); // Return empty collection if role not found
    }
}
