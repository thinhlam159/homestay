<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleServiceInterface
{
    public function getAllRoles(): Collection;
    public function getRoleById(string $id): ?Role;
    public function createRole(array $data): Role;
    public function updateRole(string $id, array $data): bool;
    public function deleteRole(string $id): bool;
    public function getRoleBySlug(string $slug): ?Role; // Thêm phương thức tìm theo slug
}
