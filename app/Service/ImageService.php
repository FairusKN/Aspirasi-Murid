<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;

class ImageService
{
    /** @disregard P1009 Undefined type */
    private \Imagick $image;

    /**
     *  @param UploadedFile $file
     *  @return ImageService
     */
    public static function fromFile(UploadedFile $file): self
    {
        $processor = new self();

        /** @disregard P1009 Undefined type */
        $processor->image = new \Imagick($file->getPathname());
        return $processor;
    }

    /**
     * Converting Image to Webp
     *
     * Image is auto-saved using parm $outputPath and is not an overwrite function
     *
     * @param string $outputPath
     * @return void
     */
    public function toWebp(string $outputPath): void
    {
        $this->image->setImageFormat('webp');
        $this->image->writeImage($outputPath);
        $this->image->clear();
        $this->image->destroy();
    }
}
