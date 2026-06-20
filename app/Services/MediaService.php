<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use ZipArchive;

class MediaService
{
    protected ImageManager $manager;

    protected array $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

    protected int $maxWidth = 1920;
    protected int $thumbWidth = 400;
    protected int $quality = 82;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Process and store a single uploaded image.
     */
    public function store(UploadedFile $file, ?int $folderId = null): ?Media
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $this->allowedExtensions)) {
            return null;
        }

        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeName = Str::slug($originalName);
        $unique = $safeName . '-' . Str::random(8);

        $year = date('Y');
        $month = date('m');
        $dir = "media/{$year}/{$month}";
        $thumbDir = "media/{$year}/{$month}/thumbs";

        Storage::disk('public')->makeDirectory($dir);
        Storage::disk('public')->makeDirectory($thumbDir);

        // GIFs: store as-is (animation preserved), still generate static thumb
        if ($extension === 'gif') {
            $filename = "{$unique}.gif";
            $path = "{$dir}/{$filename}";
            Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));

            $image = $this->manager->read($file->getRealPath());
            $width = $image->width();
            $height = $image->height();

            $thumb = $this->manager->read($file->getRealPath());
            $thumb->scaleDown(width: $this->thumbWidth);
            $thumbPath = "{$thumbDir}/{$filename}";
            Storage::disk('public')->put($thumbPath, $thumb->toGif());

            return $this->record($file, $folderId, $unique, $extension, $path, $thumbPath, $width, $height);
        }

        // Standard images: optimize as webp
        $image = $this->manager->read($file->getRealPath());
        $origWidth = $image->width();
        $origHeight = $image->height();

        if ($image->width() > $this->maxWidth) {
            $image->scaleDown(width: $this->maxWidth);
        }

        $filename = "{$unique}.webp";
        $path = "{$dir}/{$filename}";
        Storage::disk('public')->put($path, $image->toWebp($this->quality));

        // Thumbnail
        $thumb = $this->manager->read($file->getRealPath());
        $thumb->coverDown($this->thumbWidth, $this->thumbWidth);
        $thumbPath = "{$thumbDir}/{$filename}";
        Storage::disk('public')->put($thumbPath, $thumb->toWebp(75));

        return $this->record($file, $folderId, $unique, 'webp', $path, $thumbPath, $origWidth, $origHeight);
    }

    /**
     * Extract a ZIP and process every image inside.
     * Returns count of successfully imported images.
     */
    public function storeZip(UploadedFile $zipFile, ?int $folderId = null): int
    {
        $imported = 0;
        $tempDir = storage_path('app/temp/' . Str::random(12));

        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0755, true);
        }

        $zip = new ZipArchive();
        if ($zip->open($zipFile->getRealPath()) !== true) {
            $this->cleanup($tempDir);
            return 0;
        }

        $zip->extractTo($tempDir);
        $zip->close();

        $files = $this->scanDirectory($tempDir);

        foreach ($files as $filePath) {
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if (!in_array($extension, $this->allowedExtensions)) {
                continue;
            }

            $uploaded = new UploadedFile(
                $filePath,
                basename($filePath),
                mime_content_type($filePath),
                null,
                true
            );

            if ($this->store($uploaded, $folderId)) {
                $imported++;
            }
        }

        $this->cleanup($tempDir);
        return $imported;
    }

    /**
     * Delete a media record and its files.
     */
    public function delete(Media $media): void
    {
        Storage::disk('public')->delete($media->path);
        if ($media->thumbnail_path) {
            Storage::disk('public')->delete($media->thumbnail_path);
        }
        $media->delete();
    }

    /**
     * Persist the media DB record.
     */
    protected function record(UploadedFile $file, ?int $folderId, string $name, string $extension, string $path, string $thumbPath, int $width, int $height): Media
    {
        return Media::create([
            'media_folder_id' => $folderId,
            'name'            => $name,
            'file_name'       => basename($path),
            'path'            => $path,
            'thumbnail_path'  => $thumbPath,
            'mime_type'       => 'image/' . $extension,
            'extension'       => $extension,
            'size'            => Storage::disk('public')->size($path),
            'width'           => $width,
            'height'          => $height,
            'alt'             => Str::headline($name),
        ]);
    }

    /**
     * Recursively scan a directory for files.
     */
    protected function scanDirectory(string $dir): array
    {
        $result = [];
        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS)
        );
        foreach ($items as $item) {
            if ($item->isFile() && !str_starts_with($item->getFilename(), '.') && !str_contains($item->getPath(), '__MACOSX')) {
                $result[] = $item->getPathname();
            }
        }
        return $result;
    }

    protected function cleanup(string $dir): void
    {
        if (!is_dir($dir)) return;
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
        }
        rmdir($dir);
    }
}