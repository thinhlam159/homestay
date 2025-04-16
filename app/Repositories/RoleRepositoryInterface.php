<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Role;
    public function create(array $data): Role;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function findBySlug(string $slug): ?Role; // Thêm phương thức tìm theo slug
}
