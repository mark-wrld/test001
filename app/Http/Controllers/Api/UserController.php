<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Notifications\Congratulations;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            [
                'users' => User::all(),
            ],
            Response::HTTP_OK
        );
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = null;
        DB::transaction(function() use ($request, &$user) {
            $user = User::create($request->getUserData());
            $user->phones()->create($request->getPhoneBookData());
            $user->countries()->create($request->getUserCountryData());
        });

        return response()->json(
            User::find($user->id),
            Response::HTTP_CREATED
        );
    }
}
