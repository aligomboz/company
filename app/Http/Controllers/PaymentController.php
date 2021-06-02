<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM payments WHERE Field = "payment_methods"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages.payment.index',[
            'payments' => Payment::with('employee','project')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.payment.create',[
            'employees' => Employee::active()->get(),
            'projects' => Project::active()->get(),
            'pay' => PaymentController::getPossibleStatuses(),
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
        $this->paymentValidation($request);
        try{
            $payment = new Payment();
            $payment->payment_cash = $request->payment_cash;
            $payment->remaining_for_batch = $request->remaining_for_batch;
            $payment->project_id = $request->project_id;
            $payment->employee_id = $request->employee_id;
            $payment->save();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('payments.index');
        }catch (\Exception $e) {
            $request->catchError = $e->getMessage();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $pay = Payment::findOrFail($payment->id);
        return view('dashboard.pages.payment.edit',[
            'payment' => $pay,
            'employees' => Employee::active()->get(),
            'projects' => Project::active()->get(),
            'pay' => PaymentController::getPossibleStatuses(),
        ]);    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $this->paymentValidation($request);

        try{      
                $payment = Payment::findOrFail($request->payment_id);
                $payment->update([
                    'payment_cash' => $request->payment_cash,
                    'remaining_for_batch'=>$request->remaining_for_batch,
                    'project_id' => $request->project_id,
                    'employee_id' => $request->employee_id,
                ]);
                toastr()->success(__('The data has been edit successfully'));
                return redirect()->route('payments.index');
        }catch (\Exception $e) {
            $request->catchError = $e->getMessage();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Payment::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been deleted successfully'));
        return redirect()->route('payments.index');
    }
    public function paymentValidation(Request $request){
        $request->validate([
            'payment_cash' => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'remaining_for_batch'=>'required',
            'project_id'=>'required',
            'employee_id'=>'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
        ]) ;
    }
}
