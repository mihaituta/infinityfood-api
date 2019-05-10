<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\User;
use Closure;
use GenTux\Jwt\Drivers\JwtDriverInterface;
use GenTux\Jwt\JwtToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Staff
{
    /**
     * Format error message
     *
     * @param $error
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function formatErrorMessage($error)
    {
        $response = [
            'responseType' => Controller::RESPONSE_ERROR,
            'data' => null,
            'errorMessage' => $error
        ];

        $statusCode = Response::HTTP_OK;

        return response()->json($response, $statusCode);
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $jwtToken = new JwtToken(app(JwtDriverInterface::class));
            $jwtToken->setToken($request->bearerToken());

            if (!$jwtToken->validate()) {
                return $this->formatErrorMessage('Not authenticated!');
            }

            /** @var User $user */
            $user = User::where('id', $jwtToken->payload('id'))->where('email', $jwtToken->payload('context.email'))->first();

            if (!$user || $user->role_id !== User::ROLE_STAFF) {
                return $this->formatErrorMessage('You need to be a staff member to access this route!');
            }

            return $next($request);

        } catch (\Exception $e) {
            return $this->formatErrorMessage($e->getMessage());
        }
    }
}
