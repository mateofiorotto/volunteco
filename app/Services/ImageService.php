<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Guarda una imagen y retorna la ruta relativa para guardar en DB
     *
     * @param UploadedFile $image
     * @param string $path Directorio donde guardar (ej: 'avatars', 'properties')
     * @return string Ruta relativa de la imagen guardada
     */
    public function storeImage($image, $path = 'images')
    {
        // Guarda la imagen en storage/app/public/{$path} con nombre auto-generado
        return $image->store($path, 'public');
    }

    /**
     * Elimina una imagen del storage
     *
     * @param string|null $path Ruta relativa de la imagen en DB
     * @return bool
     */
    public function deleteImage($path)
    {
        if (!$path) {
            return false;
        }

        // Verifica si el archivo existe antes de eliminar
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    /**
     * Actualiza una imagen: elimina la anterior y guarda la nueva
     *
     * @param UploadedFile $image Nueva imagen
     * @param string|null $oldPath Ruta de la imagen anterior en DB
     * @param string $newPath Directorio donde guardar la nueva imagen
     * @return string Ruta de la nueva imagen
     */
    public function updateImage($image, $oldPath, $newPath = 'images')
    {
        // Elimina la imagen anterior si existe
        if ($oldPath) {
            $this->deleteImage($oldPath);
        }

        // Guarda y retorna la nueva imagen
        return $this->storeImage($image, $newPath);
    }
}
