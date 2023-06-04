<?php

declare(strict_types=1);

namespace App\Repositories\Desk;

use App\Domain\Entities\Category\CategoryFactory;
use App\Domain\Entities\Desk\DeskEntity;
use App\Domain\Entities\Desk\DeskFactory;
use App\Domain\Entities\DeskImage\DeskImageFactory;
use App\Domain\Entities\Profile\ProfileFactory;
use App\Domain\Entities\User\UserFactory;
use App\Domain\ValueObjects\Desk\DeskDescription;
use App\Domain\ValueObjects\User\UserId;
use App\Models\Desk;

class DeskRepositoryImpl implements DeskRepository
{
    /**
     * {@inheritDoc}
     */
    public function getDeskList(array $select, array $with = []): array
    {
        $desks = Desk::with($with)
          ->select($select)
          ->orderBy('created_at')
          ->get();

        $entities = [];

        foreach ($desks as $desk) {
            $user = $desk->user;
            $profile = $user->profile;
            $categories = $desk->categories;
            $deskImages = $desk->deskImages;

            $deskEntity = DeskFactory::createDesk($desk);
            $userEntity = UserFactory::createUser($user);

            $profileEntity = $profile ? ProfileFactory::createProfile($profile) : null;
            $categoriesEntity = [];
            $deskImagesEntity = [];

            foreach ($categories as $category) {
              $categoriesEntity[] = CategoryFactory::createCategory($category);
            }

            if (isset($deskImages)) {
              foreach ($deskImages as $deskImage) {
                $deskImages[] = DeskImageFactory::createDeskImage($deskImage);
              }
            }

            $entities[] = [
                'desk' => $deskEntity,
                'user' => $userEntity,
                'profile' => $profileEntity,
                'categories' => $categoriesEntity,
                'images' => $deskImagesEntity,
            ];
        }

        return $entities;
    }

    /**
     * {@inheritDoc}
     */
    public function storeDesk(UserId $userId, DeskDescription $description): DeskEntity
    {
        $desk = Desk::create([
            'user_id' => $userId->getValue(),
            'description' => $description->getValue(),
        ]);

        return DeskFactory::createDesk($desk);
    }
}
