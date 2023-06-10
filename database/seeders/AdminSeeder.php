<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (LazyCollection::range(1, 10) as $id) {
            Admin::factory()->create([
                'name' => "admin$id",
                'email' => "admin$id@mail.com",
            ]);
        }
    }
}
