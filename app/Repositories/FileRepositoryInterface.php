<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;

interface FileRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?File;
    public function create(array $data): File;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
