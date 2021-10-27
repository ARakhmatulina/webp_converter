<?php

namespace Converter\WebpConverter\Contracts;

use Illuminate\Http\UploadedFile;

interface Converter
{
    public function isExtensionValid(string $extension) : bool;

    public function convert(string $file, string $directory) : bool;

    public function getPath() : string;
}