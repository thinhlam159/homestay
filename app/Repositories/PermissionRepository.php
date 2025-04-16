<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAll(): Collection
    {
        return Permission::all();
    }

    public function getById(string $id): ?Permission
    {
        return Permission::find($id);
    }

    public function create(array $data): Permission
    {
        return Permission::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $permission = Permission::find($id);
        if ($permission) {
            return $permission->update($data);
        }
        return false;
    }

    public function delete(string $id): bool
    {
        $permission = Permission::find($id);
        if ($permission) {
            return $permission->delete();
        }
        return false;
    }

    public function findBySlug(string $slug): ?Permission
    {
        return Permission::where('slug', $slug)->first();
    }
}
