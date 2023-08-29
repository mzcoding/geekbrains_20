<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface Upload
{
   public function create(UploadedFile $file): string;
}
