<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herobanner extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function translate($locale): HerobannerLocale|null
    {
        return $this->hasOne(HerobannerLocale::class)->where('locale', $locale)->first();
    }
}
