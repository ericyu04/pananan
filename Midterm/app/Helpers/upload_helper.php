<?php

use CodeIgniter\HTTP\Files\UploadedFile;

if (! function_exists('save_image')) {
    function save_image(?UploadedFile $file, string $folder, int $size): ?string
    {
        if ($file === null || ! $file->isValid() || $file->hasMoved()) 
        {
            return null;
        }

        $dir = FCPATH . 'uploads/' . $folder . '/';
        if (! is_dir($dir)) 
        {
            mkdir($dir, 0775, true);
        }

        $name = $file->getRandomName();
        $file->move($dir, $name);

        service('image')->withFile($dir . $name)->fit($size, $size, 'center')->save($dir . $name);

        return $name;
    }
}

if (! function_exists('delete_image'))
    {
    function delete_image(?string $name, string $folder): void
    {
        if (! empty($name))
        {
            @unlink(FCPATH . 'uploads/' . $folder . '/' . $name);
        }
    }
}

if (! function_exists('image_url'))
    {
    function image_url(?string $name, string $folder): string
    {
        return base_url(! empty($name) ? 'uploads/' . $folder . '/' . $name : 'images/placeholder.png');
    }
}