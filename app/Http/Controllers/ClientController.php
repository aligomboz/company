<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPossibleStatuses(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM clients WHERE Field = "AccessMethods"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    public function index()
    {
        return view('dashboard.pages.client.index' ,[
            'clients' => Client::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.client.create',[
            'access_methods' => ClientController::getPossibleStatuses(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        try{
            $client = new Client();
            $client->name = $request->name;
            $client->phone = $request->phone;
            $client->email = $request->email;
            $client->AccessMethods = $request->AccessMethods;
            $client->note = $request->note;
            $client->is_active = 1;
            $client->save();
            toastr()->success(__('The data has been saved successfully'));
            return redirect()->route('clients.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $cli = Client::findOrFail($client->id);
        return view('dashboard.pages.client.edit',[
            'client' => $cli,
            'access_methods' => ClientController::getPossibleStatuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $cli = Client::findOrFail($request->client_id);
        try{
            if(isset($request->is_active)) {
                $cli->is_active = 1;
            } else {
                $cli->is_active = 0;
            }
            $cli->update([
                'name' => $request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'AccessMethods'=>$request->AccessMethods,
                'note'=>$request->note,
            ]);

       toastr()->success(__('The data has been successfully updated'));
            return redirect()->route('clients.index');
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientRequest $request)
    {
        client::findOrFail($request->id)->delete();
        toastr()->error(__('The data has been delete successfully'));
        return redirect()->route('clients.index');
    }
}
