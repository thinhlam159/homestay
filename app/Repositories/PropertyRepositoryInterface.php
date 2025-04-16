<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Collection;

interface PropertyRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Property;
    public function create(array $data): Property;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
}
