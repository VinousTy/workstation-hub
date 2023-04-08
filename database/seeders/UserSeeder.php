<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (LazyCollection::range(1, 10) as $id) {
        User::factory()->create([
            'name' => "user$id",
            'email' => "user$id@mail.com",
        ]);
      }
    }
}
