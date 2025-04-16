<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function getAllFiles(): Collection;
    public function getFileById(string $id): ?File;
    public function createFile(array $data): File;
    public function updateFile(string $id, array $data): bool;
    public function deleteFile(string $id): bool;

    // Methods for handling file uploads and storage
    public function uploadFile(UploadedFile $file, string $directory, string $disk = 'local', ?string $fileName = null): File;
    public function deleteFileFromStorage(File $file): bool;
}
