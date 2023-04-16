<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (LazyCollection::range(1, 10) as $id) {
            Profile::factory()->create();
        }
    }
}
