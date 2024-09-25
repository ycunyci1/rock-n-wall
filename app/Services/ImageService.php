<?php

namespace App\Services;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;

class ImageService
{
    public static function getPreviewForGif(string $gifPath, ?string $outputPath = null): string
    {
        if (!$outputPath) {
            $outputPath = public_path('gifs/previews');
        }
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0755, true);
        }

        $outputFilePath = $outputPath . '/' . uniqid('preview_', true) . '.jpg';

        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open(public_path($gifPath));

        $video
            ->frame(TimeCode::fromSeconds(1))
            ->save($outputFilePath);

        return str_replace('/var/www/html/public', '', $outputFilePath);
    }
}
