<?php

namespace App\Http\Controllers\Api;

use App\Menu;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Get stores list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStores()
    {
        try {
            $stores = Store::all();
            return $this->returnSuccess($stores);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Get store by id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStore($slug)
    {
        try {
            $store = Store::where('slug', '=', $slug)->firstOrFail();
            $menus = Menu::where('store_id', $store->id)->get();

            $types = [];

            foreach ($menus as $key => $menu) {
                $types[$key] = $menu->type;
            }

            $uniqueValues = array_unique((array)$types);

            $order = ['Felul întâi', 'Fel principal', 'Fastfood', 'Pizza', 'Desert', 'Băuturi'];

            $orderedTypes = array_values(array_intersect($order, $uniqueValues));

            return $this->returnSuccess(['store' => $store, 'types' => $orderedTypes, 'menus' => $menus]);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Create a store
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|unique:stores',
                'slug' => 'unique:stores',
                'user_id' => 'nullable|exists:users,id',
                'city' => 'required',
                'previewDescription' => 'required',
                'previewImage' => 'required|image',
                'backgroundImage' => 'required|image',
                'logoImage' => 'image',
                'contactText',
                'phone1' => 'required',
                'phone2',
                'mail1' => 'required',
                'mail2',
                'aboutText',
            ];

            $messages = [

            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());

            }
            $store = new Store();

            $store->name = $request->name;
            $store->slug = Str::slug($request->name, "-");
            $store->user_id = $request->user_id;
            $store->city = $request->city;
            $store->previewDescription = $request->previewDescription;
            $store->previewImage = $request->file('previewImage')->store($store->slug, 'restaurant-images');
            $store->backgroundImage = $request->file('backgroundImage')->store($store->slug, 'restaurant-images');

            if ($request->has('logoImage'))
                $store->logoImage = $request->file('logoImage')->store($store->slug, 'restaurant-images');

            if ($request->has('contactText'))
                $store->contactText = $request->contactText;

            $store->phone1 = $request->phone1;

            if ($request->has('phone2'))
                $store->phone2 = $request->phone2;

            $store->mail1 = $request->mail1;

            if ($request->has('mail2'))
                $store->mail2 = $request->mail2;

            if ($request->has('aboutText'))
                $store->aboutText = $request->aboutText;

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
            $rules = [
                'name' => 'unique:stores',
            ];

            $messages = [
                'name.unique' => 'nameTaken'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());
            }

            $store = Store::find($id);

            if ($request->has('name')) {
                $store->name = $request->name;
                $store->slug = Str::slug($store->name, "-");
            }

            if ($request->has('user_id'))
                $store->user_id = $request->user_id;

            if ($request->has('city'))
                $store->city = $request->city;

            if ($request->has('previewDescription'))
                $store->previewDescription = $request->previewDescription;

            if ($request->hasFile('previewImage')) {
                Storage::disk('menu-images')->delete($store->previewImage);
                $store->previewImage = $request->file('previewImage')->store($store->slug, 'restaurant-images');
            }

            if ($request->hasFile('backgroundImage')) {
                Storage::disk('menu-images')->delete($store->backgroundImage);
                $store->backgroundImage = $request->file('backgroundImage')->store($store->slug, 'restaurant-images');
            }

            if ($request->hasFile('logoImage')) {
                Storage::disk('menu-images')->delete($store->logoImage);
                $store->logoImage = $request->file('logoImage')->store($store->slug, 'restaurant-images');
            }

            if ($request->has('contactText'))
                $store->contactText = $request->contactText;

            if ($request->has('phone1'))
                $store->phone1 = $request->phone1;

            if ($request->has('phone2'))
                $store->phone2 = $request->phone2;

            if ($request->has('mail1'))
                $store->mail1 = $request->mail1;

            if ($request->has('mail2'))
                $store->mail2 = $request->mail2;

            if ($request->has('aboutText'))
                $store->aboutText = $request->aboutText;

            $store->save();

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
