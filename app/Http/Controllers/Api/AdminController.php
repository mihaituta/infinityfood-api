<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Get users list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        try {
            $users = User::all();

            return $this->returnSuccess($users);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Create an user
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role_id' => 'required|regex:/^[a-zA-Z]+$/u'
            ];

            $messages = [
                'name.unique' => 'uniqueName',
                'email.unique' => 'uniqueEmail',
            ];

            $validator = Validator::make($request->all(), $rules,$messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());
            }

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;

            $user->save();

            return $this->returnSuccess($user);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Update an user
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::find($id);

            $rules = [
                'name' => 'unique:users',
                'email' => 'email|unique:users',
            ];

            $messages = [
                'name.unique' => 'uniqueName',
                'email.unique' => 'uniqueEmail',
            ];

            $validator = Validator::make($request->all(), $rules,$messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());
            }

            if ($request->has('name')) {
                $user->name = $request->name;
            }

            if ($request->has('email')) {
                $emailUser = User::where('email', $request->email)->where('id', '!=', $id)->first();

                if ($emailUser) {
                    return $this->returnBadRequest('Email is registered with another user');
                }

                $user->email = $request->email;
            }

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            if ($request->has('role_id')) {
                $user->role_id = $request->role_id;
            }

            $user->save();

            return $this->returnSuccess($user);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Delete an user
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}
