<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('middleware visitor loaded and working!!');
        $ip = $request->header('X-Forwarded-For') ?? $request->ip();
        //$ip = $request->ip();
        $cacheKey = 'visitor_' . md5($ip);

        // Hitung jika belum ada dalam cache
        if (!Cache::has($cacheKey)) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'city' => $this->getCityFromIP($ip),
                'province' => $this->getProvinceFromIP($ip),
            ]);

            // Simpan ke cache selama 1 jam (60 menit)
            Cache::put($cacheKey, true, now()->endOfDay());
            Log::info('Visitor logged',[
                'ip'=>$ip,
                'url'=>$request->fullUrl(),
            ]);
        }
        return $next($request);
    }

    protected function getCityFromIP($ip){
        return 'Unknown city';
    }

    protected function getProvinceFromIP($ip){
        return 'Unknown Province';
    }

}
