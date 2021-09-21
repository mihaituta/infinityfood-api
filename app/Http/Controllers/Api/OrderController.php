<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    /**
     * Get orders
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrders()
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();
            $orders = Order::where('store_id', $store->id)->get();

             return $this->returnSuccess($orders);
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }


    /**
     * Create an order
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createOrder(Request $request)
    {
        try {
            $rules = [
                'totalPrice' => 'required',
                'menus' => 'required',
                'name' => 'required',
                'phone' => 'required',
                'city' => 'required',
                'address' => 'required',
                'houseNr',
                'floor',
                'apartment',
                'information',
                'store_id' => 'required',
            ];

            $messages = [
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());

            }
            $order = new Order();

            $order->status = Order::STATUS_IN_PROGRESS;
            $order->totalPrice = $request->totalPrice;
            $order->menus = $request->menus;
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->city = $request->city;
            $order->address = $request->address;
            $order->store_id = $request->store_id;

            if ($request->has('houseNr'))
                $order->houseNr = $request->houseNr;

            if ($request->has('floor'))
                $order->floor = $request->floor;

            if ($request->has('apartment'))
                $order->apartment = $request->apartment;


            if ($request->has('information'))
                $order->information = $request->information;

            $order->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Update order
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request, $id)
    {
        try {
            $rules = [
                'status' => 'required',
            ];

            $messages = [
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if (!$validator->passes()) {
                return $this->returnError($validator->errors()->first());
            }

            $order = Order::find($id);

            $order->status = $request->status;

            $order->save();

            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    /**
     * Delete order
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder($id)
    {
        try {
            $user = $this->validateSession();
            $store = Store::where('user_id', $user->id)->first();
            $order = Order::findOrFail($id);
            if ($order->store_id !== $store->id) {
                return $this->returnError('You don\'t have permission to delete this order');
            }

            $order->delete();
            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }
}
