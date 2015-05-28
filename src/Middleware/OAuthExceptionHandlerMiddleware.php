<?php

namespace LucaDegasperi\OAuth2Server\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\Middleware;
use League\OAuth2\Server\Exception\OAuthException;

/*
* OAuthExceptionHandlerMiddleware
*/
class OAuthExceptionHandlerMiddleware implements Middleware
{
    public function handle($request, Closure $next)
    {
        try {

            return $next($request);

        } catch (OAuthException $e) {

            return new JsonResponse([
                    'meta'  => [
                        'code'          => 400,
                        'error_type'    => $e->errorType,
                        'error_message' => $e->getMessage(),
                    ],
                ],
                $e->httpStatusCode,
                $e->getHttpHeaders()
            );
        }
    }
}
