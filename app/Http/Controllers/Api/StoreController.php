<?php

namespace App\Http\Controllers\Api;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Get Menu list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        try {
            $user = $this->validateSession();

            if ($user->role_id === User::ROLE_ADMIN) {
                $stores = Store::where('assign', $user->id)->paginate(10);
            } else {
                $stores = Store::paginate(10);
            }

            return $this->returnSuccess($stores);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Create a menu
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $user = $this->validateSession();

            $rules = [
                'name' => 'required|unique:stores',
                'url' => 'required|unique:stores',
                'user_id' => 'nullable|exists:users,id',
                'images_id' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if (!$validator->passes()) {
                return $this->returnBadRequest('Please fill all required fields');
            }

            $store = new Store();

            $store->name = $request->name;
            $store->url = $request->url;
            $store->user_id = $request->user_id;
            $store->images_id = $request->images_id;

            $store->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Update a task
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $this->validateSession();

            $task = Task::find($id);

            if ($user->role_id === User::ROLE_USER && $user->id !== $task->assign) {
                return $this->returnError('You don\'t have permission to update this task');
            }

            if ($request->has('name')) {
                $task->name = $request->name;
            }

            if ($request->has('description')) {
                $task->description = $request->description;
            }

            if ($request->has('status')) {
                $task->status = $request->status;
            }

            if ($request->has('assign')) {
                $task->assign = $request->assign;
            }

            $task->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Delete a task
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try {
            $user = $this->validateSession();

            if ($user->role_id !== User::ROLE_ADMIN) {
                return $this->returnError('You don\'t have permission to delete this task');
            }

            $task = Task::find($id);

            $task->delete();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}
