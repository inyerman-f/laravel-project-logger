<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){
        return response()->json('derd',200);
    }
    public function index()
    {
        $projects = auth()->user()->projects;

        return response()->json([
            'success' => true,
            'data' => $projects

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'project_name' => 'required',
            'project_description' => 'required'
        ]);

        $project = new Project();
        $project->project_name = $request->project_name;
        $project->project_description = $request->project_description;
        //$project->user_id = Auth::user()->id;

        if (auth()->user()->projects()->save($project))
            return response()->json([
                'success' => true,
                'data' => $project->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Project not added'
            ], 444);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
