<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Desk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DeskSeeder extends Seeder
{
    /**
     * @var Collection
     */
    private Collection $userIds;

    public function __construct()
    {
        $this->userIds = User::pluck('id');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         foreach ($this->userIds as $userId) {
           Desk::factory()->create([
               'user_id' => $userId,
           ]);
         }
    }
}
