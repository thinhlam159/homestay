<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function getAllUsers(): Collection;
    public function getUserById(string $id): ?User;
    public function createUser(array $data): User;
    public function updateUser(string $id, array $data): bool;
    public function deleteUser(string $id): bool;
}
