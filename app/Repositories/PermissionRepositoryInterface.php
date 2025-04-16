<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

interface PermissionRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Permission;
    public function create(array $data): Permission;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function findBySlug(string $slug): ?Permission;
}
