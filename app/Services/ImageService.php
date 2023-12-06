<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageService{

    public function upload($file, $path = null, $disk = 'public', $type = null)
    {
        $path = $path ?? 'uploads';
        $name = $file->getClientOriginalName();
        $extension = 'png'; // Set the desired extension to PNG
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $filename = Str::slug($filename);
        $filename = ($type === 'logo') ? 'logo' : (($type === 'background') ? 'background' : 'favicon');
        $filename .= '.' . $extension;

        // Create the directory if it doesn't exist
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Create an image from the uploaded file
        $image = imagecreatefromstring(file_get_contents($file->getRealPath()));

        // Save the image as PNG
        imagepng($image, $path . '/' . $filename);

        // Store the image in the specified disk
        Storage::disk($disk)->put($path . '/' . $filename, file_get_contents($path . '/' . $filename));

        // Destroy the image resource
        imagedestroy($image);

        return $path . '/' . $filename;
    }

    public function delete($filename, $disk = 'public')
    {
        $file = $filename ?? 'uploads';
        // dd(Storage::disk($disk)->exists($filename));
        if (Storage::disk($disk)->exists($file)) {
            Storage::disk($disk)->delete($file);
        }
    

    }

    public function deleteAll($path = null, $disk = 'public')
    {
        $path = $path ?? 'uploads';
        $files = Storage::disk($disk)->files($path);
        Storage::disk($disk)->delete($files);

        return true;
    }

    public function deleteDirectory($path = null, $disk = 'public')
    {
        $path = $path ?? 'uploads';
        Storage::disk($disk)->deleteDirectory($path);
    }

    public function move($filename, $old_path, $new_path, $disk = 'public')
    {
        $old_path = $old_path ?? 'uploads';
        $new_path = $new_path ?? 'uploads';
        $old_file = $old_path . '/' . $filename;
        $new_file = $new_path . '/' . $filename;
        if (Storage::disk($disk)->exists($old_file)) {
            Storage::disk($disk)->move($old_file, $new_file);
        }
    }

    public function copy($filename, $old_path, $new_path, $disk = 'public')
    {
        $old_path = $old_path ?? 'uploads';
        $new_path = $new_path ?? 'uploads';
        $old_file = $old_path . '/' . $filename;
        $new_file = $new_path . '/' . $filename;
        if (Storage::disk($disk)->exists($old_file)) {
            Storage::disk($disk)->copy($old_file, $new_file);
        }
    }
}