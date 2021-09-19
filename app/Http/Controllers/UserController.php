<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function index(){
        $userList = User::select('id', 'name', 'username', 'email')->orderBy('username')->get();
        return response()->json($userList, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validate the Input
        $this->validate($request, [
        ]);

        $user = User::create($request->all());

        // for the Response limit the elements of the newly created User
        // to those that are also transfered in the Ressource List.
        $user = $user->only([
            'id',
            'name',
            'username',
            'email'
        ]);

        // Return the shortened entry of the new User to the Frontend,
        // so the Frontend can update its own List, with the Validated Data
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        $user = $user->only([
            'id',
            'name',
            'username',
            'email'
        ]);
        return response()->json($user, Response::HTTP_OK);
    }

    public function update(Request $request, User $user)
    {
        // Validate Input
        $this->validate($request, [
        ]);

        $user->update($request->all());

        $user = $user->only([
            'id',
            'name',
            'username',
            'email'
        ]);

        return response()->json($user, Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        // Save the ID of the user to be deleted
        $id = $user->id;

        $user->delete();

        // include the id in the Response, so the Frontend can update its list.
        return response()->json($id, Response::HTTP_OK);
    }

    public function changePassword(Request $request){

        $this->validate($request, [
            'oldPassword'   =>  'required',
            'newPassword'   =>  'required|confirmed|min:6'
        ]);

        $token = JWTAuth::getToken();
        $username = JWTAuth::getPayload($token)->toArray()["username"];

        $user = User::where('username', $username)->first();
        if (Hash::check($request['oldPassword'], $user->password)){
            $user->password = Hash::make($request['newPassword']);
            $user->save();
            return response()->json(true, Response::HTTP_OK);
        }

        return response()->json(false, Response::HTTP_BAD_REQUEST);


    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
