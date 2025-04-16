<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService implements FileServiceInterface
{
    protected FileRepositoryInterface $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getAllFiles(): Collection
    {
        return $this->fileRepository->getAll();
    }

    public function getFileById(string $id): ?File
    {
        return $this->fileRepository->getById($id);
    }

    public function createFile(array $data): File
    {
        return $this->fileRepository->create($data);
    }

    public function updateFile(string $id, array $data): bool
    {
        return $this->fileRepository->update($id, $data);
    }

    public function deleteFile(string $id): bool
    {
        return $this->fileRepository->delete($id);
    }

    public function uploadFile(UploadedFile $uploadedFile, string $directory, string $disk = 'local', ?string $fileName = null): File
    {
        $fileNameToStore = $fileName ?? pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $uploadedFile->getClientOriginalExtension();
        $filePath = $uploadedFile->storeAs($directory, $fileNameToStore, $disk);

        $fileData = [
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $filePath,
            'mime_type' => $uploadedFile->getClientMimeType(),
            'file_size' => $uploadedFile->getSize(),
            'disk' => $disk,
        ];

        return $this->createFile($fileData);
    }

    public function deleteFileFromStorage(File $file): bool
    {
        return Storage::disk($file->disk)->delete($file->file_path);
    }
}
