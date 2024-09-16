<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $acceptLanguage = $request->header('Accept-Language');
        $locale = $this->parseLocale($acceptLanguage);

        if (in_array($locale, Config::get('app.locales'))) {
            App::setLocale($locale);
        } else {
            App::setLocale(Config::get('app.fallback_locale'));
        }

        return $next($request);
    }

    /**
     * Parse the 'Accept-Language' header to extract the primary locale.
     *
     * @param  string  $acceptLanguage
     * @return string
     */
    private function parseLocale($acceptLanguage)
    {
        if (!$acceptLanguage) {
            return null;
        }

        $locales = explode(',', $acceptLanguage);
        foreach ($locales as $locale) {
            $parts = explode(';', $locale);
            $lang = trim($parts[0]);
            if (!empty($lang)) {
                return substr($lang, 0, 2);
            }
        }

        return null;
    }
}
