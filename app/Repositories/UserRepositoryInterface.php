<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?User;
    public function create(array $data): User;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
