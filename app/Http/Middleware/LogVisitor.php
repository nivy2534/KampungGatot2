<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

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
        try {
            // Skip for local IPs
            if ($ip === '127.0.0.1' || $ip === '::1' || strpos($ip, '192.168.') === 0 || strpos($ip, '10.') === 0) {
                return 'Local';
            }
            
            $position = Location::get($ip);
            return $position ? $position->cityName : 'Unknown';
        } catch (\Exception $e) {
            Log::error('Error getting city from IP: ' . $e->getMessage());
            return 'Unknown';
        }
    }

    protected function getProvinceFromIP($ip){
        try {
            // Skip for local IPs
            if ($ip === '127.0.0.1' || $ip === '::1' || strpos($ip, '192.168.') === 0 || strpos($ip, '10.') === 0) {
                return 'Local';
            }
            
            $position = Location::get($ip);
            return $position ? $position->regionName : 'Unknown';
        } catch (\Exception $e) {
            Log::error('Error getting province from IP: ' . $e->getMessage());
            return 'Unknown';
        }
    }

}
