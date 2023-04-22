<?php

declare(strict_types=1);

namespace Tests\Feature\Traits\Profile;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait ProfileTrait
{
    public function setupUseProfileData(Collection $uses): Collection
    {
      return $uses->each(function (User $user) {
          Profile::factory()->create(['user_id' => $user->id]);
      });
    }
}
