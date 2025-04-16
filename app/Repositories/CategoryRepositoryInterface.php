<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Category;
    public function create(array $data): Category;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function findBySlug(string $slug): ?Category;
}
