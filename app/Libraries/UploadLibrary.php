<?php

namespace App\Libraries;

use CodeIgniter\Files\File;

class UploadLibrary
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function upload($path = 'uploads', $newName = null)
    {
        if ($this->file->isValid() && !$this->file->hasMoved()) {
            $newName = $newName ?: $this->file->getRandomName();
            $this->file->move(LIBRARY_PATH . '/' . $path, $newName);
            return [
                'success' => true,
                'file_name' => $newName,
                'path_file_name' => LIBRARY_PATH . '/' . $path . '/' . $newName,
                'message' => 'File uploaded successfully!'
            ];
        } else {
            return [
                'success' => false,
                'message' => $this->file->getErrorString()
            ];
        }
    }
}
