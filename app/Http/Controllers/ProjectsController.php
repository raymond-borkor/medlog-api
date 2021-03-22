<?php

namespace App\Http\Controllers;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|max:255|string',
            'date' => 'required|string',
            'type' => 'required|string',
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
        $project = new Projects();
        $init_string = "PROJ";
        $project->project_code = $init_string.mt_rand(0, 999);
        $project->project_name = $request['project_name'];
        $project->initiator = Auth::user()->name;
        $project->unit = Auth::user()->unit;
        $project->date = $request['date'];
        $project->type = $request['type'];
        $project->file_number = $request['file_number'];
        $project->mission_code = $request['mission_code'];
        $project->location = $request['location'];
        $project->status = $request['status'];
        $project->init_contact = $request['init_contact'];
        $project->email = $request['email'];
        $project->pharmacist = $request['pharmacist'];
        $project->exchange_rate = $request['exchange_rate'];
        $project->order_number = $request['order_number'];
        $project->reference = $request['reference'];
        $project->save();
        return response(['message' => $project, 'response'=>"data saved"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $projects)
    {
        //
    }
}
