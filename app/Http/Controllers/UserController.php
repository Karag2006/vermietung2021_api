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
            'name'      =>  'required|string|max:50',
            'username'  =>  'required|string|unique:users|max:30',
            'email'     =>  'required|string|email|max:191',
            'password'  =>  'required|string|confirmed|min:6|max:191'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // for the Response limit the elements of the newly created User
        // to those that are also transfered in the Ressource Index.
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
            'name'      =>  'required|string|max:191',
            // username is unique in the database.
            // if the username is unchanged this would cause a database error
            // so we have to exclude the username field of the current user from the unique validation
            'username'  =>  'required|string|max:191|unique:users,username,' . $user->id,
            'email'     =>  'required|string|email|max:191',
            'password'  =>  'sometimes|string|confirmed|min:6|max:191'
        ]);

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

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

        // the current user is allowed to be here since he has a valid token
        // the only way to know who the authenticated user actually is, is to look into the token
        // and extract the custom claim "username" that was injected when the token was created.

        $token = JWTAuth::getToken();
        $username = JWTAuth::getPayload($token)->toArray()["username"];

        // users can only change thier own password so we change the Password of the person named in the token.

        // JWT Token would not be valid if someone messed with the contained data,
        // so we can assume the person named in the token is in fact the token holder,
        // to be sure, they need to confirm with their old valid password.

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
