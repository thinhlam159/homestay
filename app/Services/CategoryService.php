<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    public function getCategoryById(string $id): ?Category
    {
        return $this->categoryRepository->getById($id);
    }

    public function createCategory(array $data): Category
    {
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(string $id, array $data): bool
    {
        $category = $this->getCategoryById($id);
        if ($category && (!isset($data['slug']) || empty($data['slug']) || (isset($data['name']) && $data['name'] != $category->name && (!isset($data['slug']) || empty($data['slug']))))) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(string $id): bool
    {
        return $this->categoryRepository->delete($id);
    }

    public function getCategoryBySlug(string $slug): ?Category
    {
        return $this->categoryRepository->findBySlug($slug);
    }
}
