<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll(): Collection
    {
        return Role::all();
    }

    public function getById(string $id): ?Role
    {
        return Role::find($id);
    }

    public function create(array $data): Role
    {
        return Role::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $role = Role::find($id);
        if ($role) {
            return $role->update($data);
        }
        return false;
    }

    public function delete(string $id): bool
    {
        $role = Role::find($id);
        if ($role) {
            return $role->delete();
        }
        return false;
    }

    public function findBySlug(string $slug): ?Role
    {
        return Role::where('slug', $slug)->first();
    }
}
