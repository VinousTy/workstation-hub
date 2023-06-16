<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Common\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, SerializeDate;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
