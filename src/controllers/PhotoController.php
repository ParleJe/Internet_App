<?php


class PhotoController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_EXTENSIONS = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    public function validatePhoto(array $file): bool
    {

        if ($file['size'] > self::MAX_FILE_SIZE) {
            return false;
        }
        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_EXTENSIONS)) {
            return false;
        }
        return true;
    }

    public function getUploadDirectory(array $file): string {
        return self::UPLOAD_DIRECTORY.$file['name'];
    }
}