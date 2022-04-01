<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
use App\Http\Controllers\Api\AuthController;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = auth()->user()->projects;

        return response()->json([
            'success' => true,
            'data' => $projects

        ]);

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
        $project->user_id = auth()->user()->getAuthIdentifier();

        if ($project->save())
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
        return response()->json($project);
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
        //$post = auth()->user()->posts()->find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 400);
        }

        $updated = $project->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'success' => true,
                'message'=>$project
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post can not be updated'
            ], 500);
        //return response()->json($request );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function obliterate(Project $project)
    {
        if ($project->delete()) {
            return response()->json([
                'success' => true,
                'mesage' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post can not be deleted'
            ], 500);
        }
    }

}
