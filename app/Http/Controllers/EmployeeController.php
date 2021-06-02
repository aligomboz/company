<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM employees WHERE Field = "contract"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    public function index()
    {
        return view('dashboard.pages.employee.index',[
            'employees'=>Employee::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.employee.create',[
            'cont' => EmployeeController::getPossibleStatuses(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // try{
            $embloyee = new Employee();
            $embloyee->name = $request->name;
            $embloyee->phone = $request->phone;
            $embloyee->email = $request->email;
            $embloyee->start_job = $request->start_job;
            $embloyee->end_job = $request->end_job;
            $embloyee->contract = $request->contract;
            $embloyee->sallary = $request->sallary;
            $embloyee->description = $request->description;
            $embloyee->is_active = 1;
            $embloyee->save();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('employees.index');
        // }catch (\Exception $e) {
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $emp = $employee->findOrFail($employee->id);
        return view('dashboard.pages.employee.edit',[
            'employee' => $emp,
            'cont' => EmployeeController::getPossibleStatuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $embloyee = Employee::findOrFail($request->employee_id);
        try{
            if(isset($request->is_active)) {
                $embloyee->is_active = 1;
            } else {
                $embloyee->is_active = 0;
            }
                $embloyee->update([
                    'name' => $request->name,
                    'phone'=>$request->phone,
                    'email'=>$request->email,
                    'start_job'=>$request->start_job,
                    'end_job'=>$request->end_job,
                    'contract'=>$request->contract,
                    'sallary'=>$request->sallary,
                    'description'=>$request->description,
                ]);
                toastr()->success(__('The data has been edit successfully'));
                return redirect()->route('employees.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        Employee::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('employees.index');
    }
}
