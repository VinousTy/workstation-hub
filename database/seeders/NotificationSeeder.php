<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        foreach (LazyCollection::range(1, 10) as $id) {
          $data[$id] = Notification::factory()->make()->toArray();
        }

        Notification::insert($data);
    }
}
