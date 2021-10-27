<?php

namespace Mechta\WebpConverter\Services;

use Mechta\WebpConverter\Contracts\Converter;

class WebpConverter implements Converter
{
    const COMPRESSION_QUALITY = 80;

    private array $extensions = [
        'jpeg',
        'jpg',
        'gif',
        'png',
        'svg'
    ];

    private string $newSavePath;

    public function isExtensionValid(string $extension): bool
    {
        return in_array(strtolower($extension), $this->extensions);
    }

    public function convert(string $file, string $directory): bool
    {
        $extension = $this->getExtension($file);

        if (! $this->isExtensionValid($extension)) {
            return false;
        }

        $oldFile = "storage/$directory/$file" ;

        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($oldFile);
                break;

            case 'png':
                $image = imagecreatefrompng($oldFile);
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;

            case 'gif':
                $image = imagecreatefromgif($oldFile);
                break;
            default:
                return false;
        }

        $this->newSavePath = str_replace($extension, '.webp', $oldFile);

        $result = imagewebp($image, $this->newSavePath, self::COMPRESSION_QUALITY);

        if (false === $result) {
            return false;
        }

        imagedestroy($image);
        unlink($oldFile);

        return true;
    }

    private function getExtension(string $file) : string
    {
        $nameExploded = explode('.', $file);
        if (empty($nameExploded)) {
            return "";
        }

        return $nameExploded[count($nameExploded) - 1];
    }

    public function getPath() : string
    {
        return $this->newSavePath ?? "";
    }
}