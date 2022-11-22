<?php
namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PokemonManager{
    public function uploadImage(UploadedFile $image, $target){
        $filename = uniqid().".".$image -> guessExtension();
        if (!is_dir($target)) {
            mkdir($target, 0777);
        }
        $image -> move($target, $filename);
        return $filename;
    }
}
?>