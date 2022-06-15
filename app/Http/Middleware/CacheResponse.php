<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isActive = $this->isActive();
        $identifier = $this->getRequestIdentifier($request);

        if($isActive && Cache::has($identifier)) {
            $lifetime = $this->getCacheLifetime();
            
            $headers = [
                'X-CACHE-RESPONSE' => $lifetime,
            ];

            return response(Cache::get($identifier))->withHeaders($headers);
        }

        return $next($request);
    }

    public function terminate(Request $request, Response $response)
    {
        $isActive = $this->isActive();
        $isValid = $response->isSuccessful();

        $identifier = $this->getRequestIdentifier($request);
        $lifetime = $this->getCacheLifetime();

        if($isActive && $isValid) {
            Cache::remember($identifier, $lifetime, function() use($response) {
                return $response->getContent();
            });
        }
    }

    private function getRequestIdentifier(Request $request)
    {
        return $request->getRequestUri();
    }

    private function isActive()
    {
        return config('cache-response.active');
    }

    private function getCacheLifetime()
    {
        return config('cache-response.lifetime');
    }
}
