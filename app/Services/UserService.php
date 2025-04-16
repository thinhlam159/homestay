<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getUserById(string $id): ?User
    {
        return $this->userRepository->getById($id);
    }

    public function createUser(array $data): User
    {
        // Hash password trước khi tạo user
        $data['password'] = Hash::make($data['password']);
        $data['id'] = User::newUlid();
        return $this->userRepository->create($data);
    }

    public function updateUser(string $id, array $data): bool
    {
        // Hash password nếu password được cập nhật
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser(string $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
