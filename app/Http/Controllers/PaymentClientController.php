<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\PaymentClient;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM payment_clients WHERE Field = "payments"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    public function index()
    {
        return view('dashboard.pages.paymentClient.index',[
            'paymentClients'=>PaymentClient::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.paymentClient.create',[
            'payment' =>PaymentClientController::getPossibleStatuses(),
            'clients' => Client::active()->get(),
            'projects' => Project::active()->get(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentClient  $paymentClient
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentClient $paymentClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentClient  $paymentClient
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentClient $paymentClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentClient  $paymentClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentClient $paymentClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentClient  $paymentClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentClient $paymentClient)
    {
        //
    }
    public function clientProject($id)
    {
        $project = Project::where("client_id", $id)->pluck("name", "id");
        return $project;
    }
    public function projectPrice($id)
    {
        $project = Project::where("client_id", $id)->pluck("price", "id");
        return $project;
    }
}
