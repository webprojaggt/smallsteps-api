<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ExpoPushToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use stdClass;

class NotificationController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'expoPushToken' => 'required|string',
            'active' => 'boolean'
        ]);

        $isActive = true;
        if (isset($request->active)) {
            $isActive = $request->active;
        }

        $existingToken = ExpoPushToken::where('token', $request->expoPushToken)
            ->first();

        if ($existingToken) {
            if (auth('sanctum')->check() && (!isset($existingToken->user_id) || $existingToken->user_id != auth('sanctum')->user()->id)) {
                $existingToken->update(['user_id' => auth('sanctum')->user()->id]);
            }
            if (!$existingToken->active && $isActive) {
                $existingToken->update(['active' => true]);
            } else if ($existingToken->active && !$isActive) {
                $existingToken->update(['active' => false]);
            }
        } else {
            $pushToken = [
                "token" => $request->expoPushToken,
                "active" => $isActive,
            ];

            if (auth('sanctum')->check()) {
                $pushToken['user_id'] = auth('sanctum')->user()->id;
            }

            ExpoPushToken::create($pushToken);
        }

        $this->setUserNotificationsSet($isActive);

        return response()->json(['data' => []], 200);
    }

    public function unsubscribe(Request $request)
    {
        $request->validate([
            'expoPushToken' => 'required|string',
        ]);

        $existingToken = ExpoPushToken::where('token', $request->expoPushToken)
            ->first();

        if (!$existingToken) {
            return response()->json(['data' => []], 404);
        }

        $existingToken->update(['active' => false]);

        $this->setUserNotificationsSet(false);

        return response()->json(['data' => []], 200);
    }

    public function send(Request $request){
        $request->validate([
            'name' => 'required|string',
            'info' => 'required|string',
            'newsId' => 'integer',
            'link' => 'string',
        ]);

        $pushTokens = ExpoPushToken::where('active', 1)
            ->get()->map(function ($pushToken) {
                return $pushToken->token;
            })->toArray();

        $requestBody = [
            "to" => $pushTokens,
            "title" => $request->Name,
            "body" => $request->Info,
        ];

        $requestData = new stdClass();

        if (isset($request->Eve_id)) {
            $requestData->eventId = $request->Eve_id;
        }
        if (isset($request->Link)) {
            $requestData->link = $request->Link;
        }

        $requestBody['data'] = json_encode($requestData);

        return $this->sendRequests($pushTokens, $requestBody);
    }

    function sendRequests(array $pushTokens, array $requestBody)
    {
        $results = [];

        foreach (array_chunk($pushTokens, 100) as $chunk) {
            $requestBody['to'] = $chunk;

            $response = Http::post("https://exp.host/--/api/v2/push/send", $requestBody);

            if ($response->failed()) {
                $results[] = ['status' => 'failed', 'error' => $response->body()];
            } else {
                $results[] = ['status' => 'success', 'response' => $response->json()];
            }

            usleep(16700); // sleep for 16.7ms to limit to 600 notifications per second
        }

        $failures = array_filter($results, function ($result) {
            return $result['status'] == 'failed';
        });

        $successes = array_filter($results, function ($result) {
            return $result['status'] == 'success';
        });

        if (count($failures) > 0) {
            return response()->json(['message' => 'Some requests failed', 'successes' => $successes, 'failures' => $failures], 200);
        } else {
            return response()->json(['message' => 'All requests succeeded', 'results' => $results], 200);
        }
    }

    private function setUserNotificationsSet(bool $notificationsSet) {
        if (auth('sanctum')->check()) {
            $user = User::findOrFail(auth()->user()->id);;
            $user->update(['notifications_set' => $notificationsSet]);
        }
    }
}
