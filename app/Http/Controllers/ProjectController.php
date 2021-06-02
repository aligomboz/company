<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Image;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.project.index',[
            'projects' => Project::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.project.craete',[
            'clients' => Client::active()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        DB::beginTransaction();
        try{
            $project = new Project();
            $project->name = $request->name;
            $project->requirements_name = $request->requirements_name;
            $project->start_date = $request->start_date;
            $project->end_date = $request->end_date;
            $project->price = $request->price;
            $project->client_id = $request->client_id;
            $project->description = $request->description;
            $project->is_active = 1;
            $project->save();

            if($request->hasfile('files'))
            {
                foreach($request->file('files') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/projects/'.$project->name, $file->getClientOriginalName(),'upload_attachments');
                    // insert in image_table
                    $images= new Image();
                    $images->filename = $name;
                    $images->imageable_id = $project->id;
                    $images->imageable_type = Project::class;
                    $images->save();
                }
            }
            DB::commit();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('projects.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $pro = $project->findOrFail($project->id);
        return view('dashboard.pages.project.show',[
            'project' =>$pro,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $pro = $project->findOrFail($project->id);
        return view('dashboard.pages.project.edit',[
            'project' => $pro,
            'clients' => Client::active()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $pro = $project->findOrFail($project->id);
        if(isset($request->is_active)) {
            $pro->is_active = 1;
        } else {
            $pro->is_active = 0;
        }
        $pro->update([
            'name' =>$request->name,
            'requirements_name' =>$request->requirements_name,
            'start_date' =>$request->start_date,
            'end_date' => $request->end_date,
            'price' =>$request->price,
            'client_id' => $request->client_id,
            'description' => $request->description,
        ]);
        toastr()->success(__('The data has been saved successfully'));
        return redirect()->route('projects.index');
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

    public function upload_attachment(Request $request){
        
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/projects/'.$request->project_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new Image();
            $images->filename=$name;
            $images->imageable_id = $request->project_id;
            $images->imageable_type = Project::class;
            $images->save();
        }
        toastr()->success(__('The data has been saved successfully'));
        return redirect()->route('projects.show',$request->project_id);
    }

    public function download_attachment($projectname,$filename){
        return response()->download(public_path('attachments/projects/'.$projectname.'/'.$filename));
    }

    public function delete_attachment(Request $request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/projects/'.$request->project_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('projects.show',$request->project_id);
    }
}
