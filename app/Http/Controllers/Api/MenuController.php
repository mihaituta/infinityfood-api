<?php

namespace App\Http\Controllers\Api;

use App\Menu;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Get Menu list
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMenus()
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();
            $menus = Menu::where('store_id', $store->id)->get();

            return $this->returnSuccess($menus);
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
    public function createMenu(Request $request)
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();

            $rules = [
                'name' => 'required|unique:menus,name,NULL,id,store_id,'.$store->id,
                'description' => 'required',
                'price' => 'required',
                'image' => 'required|image',
                'type' => 'required',
                'store_id' => 'exists:stores,id',

            ];
            $messages = [
                    'name.unique' => 'nameTaken'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                //return $this->returnBadRequest('Please fill all required fields');
              return $this->returnError($validator->errors()->first());

            }


            $menu = new Menu();

            $menu->name = $request->name;
            $menu->description = $request->description;
            $menu->price = $request->price;
            $menu->image = $request->file('image')->store($store->name, 'menu-images');
            $menu->type = $request->type;
            $menu->store_id = $store->id;

            $menu->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Update menu
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateMenu(Request $request, $id)
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();
            $menu = Menu::find($id);

            $rules = [
                'name' => 'unique:menus,name,'.$menu->id.',id,store_id,'.$store->id,
            ];

            $messages = [
                'name.unique' => 'nameTaken'
            ];
            $validator = Validator::make($request->all(), $rules,$messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());
            }

            if ($menu->store_id !== $store->id) {
                return $this->returnError('You don\'t have permission to update this menu');
            }

            if ($request->has('name')) {
                $menu->name = $request->name;
            }

            if ($request->has('description')) {
                $menu->description = $request->description;
            }

            if ($request->has('price')) {
                $menu->price = $request->price;
            }

            if ($request->hasFile('image')) {
                Storage::disk('menu-images')->delete($menu->image);
                $menu->image = $request->file('image')->store($store->name, 'menu-images');
            }

            if ($request->has('type')) {
                $menu->type = $request->type;
            }

            $menu->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Delete menu
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMenu($id)
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();
            $menu = Menu::findOrFail($id);
            if ($menu->store_id !== $store->id) {
                return $this->returnError('You don\'t have permission to delete this menu');
            }

            //$menu = Menu::where('id',$id)->where('store_id',$store->id)->firstOrFail();
            Storage::disk('menu-images')->delete($menu->image);
            $menu->delete();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}
