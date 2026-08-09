<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Generate a temporary, signed S3 URL for the submitted video file.
     * The bucket is private, so this must always be a signed URL rather
     * than a permanent public link.
     */
    public function videoUrl(int $minutes = 360): ?string
    {
        if (! $this->video) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl($this->video, now()->addMinutes($minutes));
    }

    /**
     * Generate a short-lived, signed S3 URL for the signature image.
     */
    public function signatureUrl(int $minutes = 30): ?string
    {
        if (! $this->signature) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl($this->signature, now()->addMinutes($minutes));
    }
}
