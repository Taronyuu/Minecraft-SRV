<?php

namespace App\Http\Controllers;

use App\Helpers\Cloudflare;
use App\Models\Record;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class RecordController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Requests\PostRecordRequest $request)
    {
        //Create the record in the database
        $record = Record::create($request->all());

        //Create an A record using the Cloudflare Api
        $cloudflare = new Cloudflare();
        $aRecord = $cloudflare->createARecord($record->name, $record->ip);

        //If the api call failed, delete the database record
        if($aRecord['result'] != 'success'){
            $record->delete();

            return redirect()->back()->with('error', 'Something went wrong while adding your record');
        }

        //Else save the record id from Cloudflare with the record in our database
        $record->rec_id_a = $aRecord['response']['rec']['obj']['rec_id'];

        //Create an SRV record using the Cloudflare Api
        $srvRecord = $cloudflare->createSrvRecord($record->name, $record->ip, $record->port);

        //If the api call failed, delete the database record
        if($srvRecord['result'] != 'success'){
            $record->delete();

            return redirect()->back()->with('error', 'Something went wrong while adding your record');
        }

        //Else save the record id from Cloudflare with the record in our database
        $record->rec_id_srv = $srvRecord['response']['rec']['obj']['rec_id'];
        $record->token = str_random(100);
        $record->save();

        //Create an url to delete this record including an random token
        $url = action('RecordController@destroy', [$record->id, $record->token]);

        //Send the user an email
        Mail::send('mail.destroy', compact('url'), function($m)use($record){
            $m->from('info@' . env('CLOUDFLARE_DOMAIN'), env('CLOUDFLARE_DOMAIN'));
            $m->to($record->email);
            $m->subject('Your record has been created');
        });

        return redirect()->back()->with('success', 'Your record has been added successfully');
    }

    public function destroy($record_id, $token)
    {
        $record = Record::findOrFail($record_id);

        if($token != $record->token){
            return redirect()->action('RecordController@index')->with('error', 'Invalid token has been supplied');
        }

        $cloudflare = new Cloudflare();
        $aRecord = $cloudflare->deleteARecord($record->rec_id_a);
        $srvRecord = $cloudflare->deleteSrvRecord($record->rec_id_srv);

        $record->delete();

        return redirect()->action('RecordController@index')->with('success', 'Record has been deleted');
    }
}
