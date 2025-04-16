<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

interface PermissionServiceInterface
{
    public function getAllPermissions(): Collection;
    public function getPermissionById(string $id): ?Permission;
    public function createPermission(array $data): Permission;
    public function updatePermission(string $id, array $data): bool;
    public function deletePermission(string $id): bool;
    public function getPermissionBySlug(string $slug): ?Permission;
}
