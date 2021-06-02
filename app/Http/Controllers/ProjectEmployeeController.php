<?php

namespace App\Http\Controllers;

use App\Http\Requests\projectEmbloyeeRequest;
use App\Models\Employee;
use App\Models\Project;
use App\Models\ProjectEmployee;
use Illuminate\Http\Request;

class ProjectEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.projectEmployee.index',[
            'embloyeeProjects' => ProjectEmployee::with('employee','project')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.projectEmployee.create',[
            'embloyees' => Employee::active()->get(),
            'projects' => Project::active()->get(),        
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(projectEmbloyeeRequest $request)
    {
        try{
            $projectEmbloyee = new ProjectEmployee();
            $projectEmbloyee->embloyee_id = $request->embloyee_id;
            $projectEmbloyee->project_id = $request->project_id;
            $projectEmbloyee->type_job = $request->type_job;
            $projectEmbloyee->save();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('embloyeeProjects.index');
        }catch (\Exception $e) {
            $request->catchError = $e->getMessage();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectEmployee  $projectEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectEmployee $projectEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectEmployee  $projectEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectEmployee $embloyeeProject)
    {
        $embloyee = ProjectEmployee::findOrFail($embloyeeProject->id);
        return view('dashboard.pages.projectEmployee.edit',[
            'embloyees' => Employee::get(),
            'projects' => Project::get(),      
            'embloyeeProject' => $embloyee,  
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectEmployee  $projectEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectEmployee $projectEmployee)
    {
        try{      
                $embloyeeProject = ProjectEmployee::findOrFail($request->id);
                $embloyeeProject->update([
                    'embloyee_id' => $request->embloyee_id,
                    'project_id'=>$request->project_id,
                    'type_job'=>$request->type_job,
                ]);
                toastr()->success(__('The data has been edit successfully'));
                return redirect()->route('embloyeeProjects.index');
        }catch (\Exception $e) {
            $request->catchError = $e->getMessage();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectEmployee  $projectEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ProjectEmployee::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('embloyeeProjects.index');
    }
}
