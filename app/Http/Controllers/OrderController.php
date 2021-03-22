<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index()
    {
        $projrequest = Orders::with('project', 'item', 'category')->get();
        return response(['message' => 'all requests' ,'request' => $projrequest], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project' => 'required',
            'item' => 'required',
            'quantity' => 'required',
            'units' => 'required',
            'category' => 'required'
        ]);
        if ($validator->fails())
        {
            return response(['error' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $projrequest = Orders::create($input);
        return response(['message' => 'Request Saved', 'request_made' => $projrequest], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|ResponseFactory|Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project' => 'required',
            'item' => 'required',
            'quantity' => 'required',
            'units' => 'required',
            'category' => 'required'
        ]);
        if ($validator->fails())
        {
            return response(['message' => $validator->errors()->all()], 422);
        }
        $input = $request->all();
        $orders = Orders::all()->where('id', $id);
        if ($orders->isEmpty()){
            return response(['message' => 'Data Not found'], 422);
        }
        $orders = Orders::find($id);
        $orders->update($input);
        return response(['message' => 'Request Updated', 'request' => $orders, 'input' => $input], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|ResponseFactory|Response
     */
    public function destroy($id)
    {
        $orders = Orders::destroy($id);
        if (!$orders){
            return response(['message' => "Record not found"]);
        }
        return response(['message' => 'Request Data Deleted'], 200);
    }
}
