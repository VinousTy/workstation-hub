<?php

declare(strict_types=1);

namespace App\Repositories\Image;

use App\Domain\Entities\Profile\ProfileEntity;
use App\Domain\Entities\Profile\ProfileFactory;
use App\Models\DeskImage;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class ImageRepositoryImpl implements ImageRepository
{
    /**
     * {@inheritDoc}
     */
    public function uploadImageFile(string $id, string $filePath): ProfileEntity
    {
        $profile = DB::transaction(function () use ($id, $filePath) {
          $profile = Profile::findOrFail($id);
          $profile->file_path = $filePath;
          $profile->save();

          return $profile;
        });

        return ProfileFactory::createProfile($profile);
    }

    /**
     * {@inheritDoc}
     */
    public function uploadDeskImageFile(string $deskId, string $fileName, string $extension, string $filePath): void
    {
        DeskImage::create([
            'desk_id' => $deskId,
            'file_name' => $fileName,
            'extension' => $extension,
            'file_path' => $filePath,
        ]);
    }
}
