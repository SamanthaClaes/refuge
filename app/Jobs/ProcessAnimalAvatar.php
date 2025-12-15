<?php

namespace App\Jobs;

use App\Models\Animal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessAnimalAvatar implements ShouldQueue
{
    use Queueable;

    protected string $fileName;
    protected string $fullPath;

    public function __construct(string $fileName, string $fullPath)
    {
        $this->fileName = $fileName;
        $this->fullPath = $fullPath;
    }

    public function handle(): void
    {
        $imageContent = Storage::disk('public')->get($this->fullPath);
        $image = Image::read($imageContent);

        $sizes = [100, 200, 400];
        $compression = 85;
        $variantPathTemplate = 'avatars/%s/';

        foreach ($sizes as $size) {
            $resizedImage = $image
                ->scale($size, $size)
                ->toJpeg($compression);

            $variantPath = sprintf($variantPathTemplate, $size);
            $fullVariantPath = $variantPath . '/' . $this->fileName;

            Storage::disk('public')->put($fullVariantPath, $resizedImage);
        }
    }
}
