<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str; // Import Str class

class RoleService implements RoleServiceInterface
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles(): Collection
    {
        return $this->roleRepository->getAll();
    }

    public function getRoleById(string $id): ?Role
    {
        return $this->roleRepository->getById($id);
    }

    public function createRole(array $data): Role
    {
        // Tạo slug tự động từ name nếu slug không được cung cấp
        if (!isset($data['slug']) || empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->roleRepository->create($data);
    }

    public function updateRole(string $id, array $data): bool
    {
        // Tạo slug tự động từ name nếu slug không được cung cấp hoặc name thay đổi
        $role = $this->getRoleById($id);
        if ($role && (!isset($data['slug']) || empty($data['slug']) || (isset($data['name']) && $data['name'] != $role->name && (!isset($data['slug']) || empty($data['slug']))))) {
            $data['slug'] = Str::slug($data['name']);
        }
        return $this->roleRepository->update($id, $data);
    }

    public function deleteRole(string $id): bool
    {
        return $this->roleRepository->delete($id);
    }

    public function getRoleBySlug(string $slug): ?Role
    {
        return $this->roleRepository->findBySlug($slug);
    }
}
