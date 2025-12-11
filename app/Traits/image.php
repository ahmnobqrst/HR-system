<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;

trait image
{
    public function uploadImageimage($image, $folder)
    {
      $rand = rand(999999, 1000000);
      $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move(storage_path('app/public/' . $folder), $imageName);
      return $folder . '/' . $imageName;
    }

    public function delete_file($filename)
    {
      if ($filename) {
      
        if (File::exists(storage_path('app/public/' . $filename))) {
          File::delete(storage_path('app/public/' . $filename));
        }
      }
    }

}