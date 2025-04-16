<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    public function getAllCategories(): Collection;
    public function getCategoryById(string $id): ?Category;
    public function createCategory(array $data): Category;
    public function updateCategory(string $id, array $data): bool;
    public function deleteCategory(string $id): bool;
    public function getCategoryBySlug(string $slug): ?Category;
}
