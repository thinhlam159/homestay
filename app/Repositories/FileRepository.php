<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;

class FileRepository implements FileRepositoryInterface
{
    public function getAll(): Collection
    {
        return File::all();
    }

    public function getById(string $id): ?File
    {
        return File::find($id);
    }

    public function create(array $data): File
    {
        return File::create($data);
    }

    public function update(string $id, array $data): bool
    {
        $file = File::find($id);
        if ($file) {
            return $file->update($data);
        }
        return false;
    }

    public function delete(string $id): bool
    {
        $file = File::find($id);
        if ($file) {
            return $file->delete();
        }
        return false;
    }
}
