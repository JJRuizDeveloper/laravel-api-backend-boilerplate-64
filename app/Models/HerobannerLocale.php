<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HerobannerLocale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function herobanner():BelongsTo
    {
        return $this->belongsTo(Herobanner::class);
    }
}
