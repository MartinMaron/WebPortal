<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserMobileRessource;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                    'message' => 'Invalid login details'
                    ], 401);
        }

        $user = (new \App\Models\User)->where('email', $request['email'])->firstOrFail();


        if ($user->isa) {
            return response()->json([
                    'message' => 'Invalid login details'
                    ], 401);
        }

        return response()->json([
                'access_token' => $user->apiToken,
                'token_type' => 'Bearer',
                'NekoWebId' => $user->id,
        ]);

    }

    public function loginMobile(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                    'message' => 'Invalid login details'
                    ], 401);
        }

        $user = (new \App\Models\User)->where('email', $request['email'])->firstOrFail();


        if ($user->isa) {
            return response()->json([
                    'message' => 'Invalid login details'
                    ], 401);
        }

        $userRessource = new UserMobileRessource($user);
        return response()->json($userRessource);

    }








    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    #[NoReturn] public function show($id)
    {
        dd("treffer");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        //
    }
}
