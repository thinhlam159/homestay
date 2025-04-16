<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class PermissionService implements PermissionServiceInterface
{
    protected PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllPermissions(): Collection
    {
        return $this->permissionRepository->getAll();
    }

    public function getPermissionById(string $id): ?Permission
    {
        return $this->permissionRepository->getById($id);
    }

    public function createPermission(array $data): Permission
    {
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->permissionRepository->create($data);
    }

    public function updatePermission(string $id, array $data): bool
    {
        $permission = $this->getPermissionById($id);
        if ($permission && (!isset($data['slug']) || empty($data['slug']) || (isset($data['name']) && $data['name'] != $permission->name && (!isset($data['slug']) || empty($data['slug']))))) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->permissionRepository->update($id, $data);
    }

    public function deletePermission(string $id): bool
    {
        return $this->permissionRepository->delete($id);
    }

    public function getPermissionBySlug(string $slug): ?Permission
    {
        return $this->permissionRepository->findBySlug($slug);
    }
}
