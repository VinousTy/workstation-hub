<?php

declare(strict_types=1);

namespace Tests\Feature\Traits\Desk;

use App\Models\Category;
use App\Models\Desk;
use App\Models\DeskImage;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait DeskTrait
{
  public function setupUseDeskData(Collection $uses, int $count): Collection
  {
    return $uses->each(function (User $user) use ($count) {
        Profile::factory()->create(['user_id' => $user->id]);
        $desks = Desk::factory()->count($count)->create([
            'user_id' => $user->id,
        ]);
        $categories = Category::factory()->count($count)->create();

        $desks->each(function (Desk $desk) use ($categories) {
            $desk->categories()->attach($categories->random());
        });

        $desks->each(function (Desk $desk) {
            DeskImage::factory()->create([
                'desk_id' => $desk->id,
            ]);
        });
    });
  }
}
