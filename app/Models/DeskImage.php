<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeskImage extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function desk(): BelongsTo
    {
        return $this->belongsTo(Desk::class);
    }
}
