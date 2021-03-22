<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Projects::all();
        return response(['projects' => $projects], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_code',
            'project_name' => 'required|max:255|string',
            'date' => 'required|string',
            'type' => 'required|string',
            'unit',
            'initiator',
            'file_number' => 'required|string',
            'mission_code' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|string',
            'init_contact' => 'required|string',
            'email' => 'required|email|string',
            'pharmacist' => 'required|string',
            'exchange_rate' => 'required|string',
            'order_number' => 'required|string',
            'reference' => 'required|string'
        ]);
        if ($validator->fails())
        {
            return response(['message' => $validator->errors()->all()], 422);
        }
        $input = $request->all();
        $init_string = "PROJ";
        $input['project_code'] = $init_string.mt_rand(0, 999);
        $input['initiator'] = Auth::user()->name;
        $input['unit'] = Auth::user()->unit;
        $project = Projects::create($input);
        return response(['message' => $project, 'response'=>"data saved"], 200);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project_code',
            'project_name' => 'required|max:255|string',
            'date' => 'required|string',
            'type' => 'required|string',
            'unit',
            'initiator',
            'file_number' => 'required|string',
            'mission_code' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|string',
            'init_contact' => 'required|string',
            'email' => 'required|email|string',
            'pharmacist' => 'required|string',
            'exchange_rate' => 'required|string',
            'order_number' => 'required|string',
            'reference' => 'required|string'
        ]);
        if ($validator->fails())
        {
            return response(['message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $projects = Projects::all()->where('id', $id);
        if($projects->isEmpty())
        {
            return response(['message' => 'Project details not found'], 422);
        }
        $projects = Orders::find($id);
        $projects->update($input);
        return response(['message' => 'Project data updated', 'data' => $projects], 200);
    }



    public function destroy($id)
    {
        $projects = Projects::destroy($id);
        if (!$projects)
        {
            return response(['message' => 'Project details not found']);
        }
        return response(['message' => 'Project Data deleted']);
    }
}
