<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Honorarium;
use App\Models\BeneficiaryDetail;
use DB, Validator, Redirect, Auth, Crypt, Input, Excel, Carbon;

class HonorariumsController extends Controller
{
    public function create() {
    	$all_beneficiaries 	= BeneficiaryDetail::pluck('inward_number', 'id');
    	return view('honorariums.create', compact('all_beneficiaries'));
    }

    public function save(Request $request) {
    	$data = $request->all();

    	$data['added_by'] = Auth::user()->id;
    	$data['pay_date'] = date('Y-m-d', strtotime($request->pay_date));
    	$validator = Validator::make($data, Honorarium::$rules);
                        if ($validator->fails()) return Redirect::back()->withErrors($validator)->withInput();

        if(Honorarium::create($data)) {
        	 return Redirect::route('honorarium.index')->with(['message' => 'Honorarium added', 'alert-class' => 'alert-success']);
        }

        return Redirect::back()->with(['message' => 'Unable to save data', 'alert-class' => 'alert-danger']);
    }

    public function index() {
    	$results = Honorarium::where('status',1)->orderBy('pay_date', 'DESC')->get();
    	return view('honorariums.index', compact('results'));
    }
}
