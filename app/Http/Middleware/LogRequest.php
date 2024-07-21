<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    public function handle(Request $request, Closure $next)
    {

        Log::channel('syslog')->info('Request received', [
            'ip' => $request->ip(),
            'user_type' => auth()->user()?->type ?? 'guest',
            'user_id' => auth()->user()?->id ?? null,
            'request_id' => Request::getId() ?: Uuid::uuid4()->toString(), 
            'input' => $request->all(),
            'target_route' => $request->route()?->getName(),
            'method' => $request->method(),
            'uri' => $request->getRequestUri(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);

        $response = $next($request);

        return $response;
    }
}