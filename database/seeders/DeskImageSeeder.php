<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\DeskImage;
use Illuminate\Database\Seeder;

class DeskImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeskImage::factory()->count(10)->create();
    }
}
