<?php

namespace App\Http\Controllers;

use App\Models\Herobanner;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class HerobannerController extends Controller
{
    /**
     * Get Latest Hero Banner
     * 
     * This endpoint retrieves the latest hero banner. It is Accept-Language to retrieve the information in the current locale language
     * @unauthenticated
     * @return JsonResponse
     */
    public function getLatestHerobanner():JsonResponse
    {
        $locale = App::getLocale();
        $hero_banner = Herobanner::orderBy('updated_at', 'desc')->first();
        return response()->json([
            'background_uri' => $hero_banner->background_uri,
            'title' => $hero_banner->translate($locale)->title,
            'text' => $hero_banner->translate($locale)->text,
            'button_text' => $hero_banner->translate($locale)->button_text,
            'button_action_uri' => $hero_banner->button_action_uri,
            'is_target_blank' => $hero_banner->is_target_blank,
        ]);
    }
}
