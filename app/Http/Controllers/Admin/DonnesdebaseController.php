<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\masterdata; 
class DonnesdebaseController extends Controller
{
    //
    public function index(){
        $master=masterdata::all();
       
     return view('backend.donnesdebase.index',compact('master'));
    }
    public function create(){
        return view('backend.donnesdebase.create');
       }
  
    public function store(Request $request) {
        //dd($request->all());
        $request->validate([
            'MTART' => 'required|string|max:4',
            'MATKL' => 'required|string|max:9',
            'MEINS' => 'required',
            'XCHPF' => 'required',
            'MAKTX' => 'required|string|max:40',
            'EKGRP' => 'required',
            'VPRSV_1' => 'required',
            'BKLAS'=>'required',
            'BSTME'=>'required',
           
        ]);

        $CheckExsists = masterdata::select('id')->where('MAKTX', $request->MAKTX)->first();
        
        if (!empty($CheckExsists)) {
            toastr()->error('Désolé, le Designation est déjà enregistré.');
            return redirect()->back();
        }
        $imo = new masterdata();
        $imo->MTART = $request->MTART;
        $imo->MATKL = $request->MATKL;//
        $imo->MEINS = $request->MEINS;//
        $imo->XCHPF = $request->XCHPF;//
        $imo->MAKTX = $request->MAKTX;//
        $imo->EKGRP = $request->EKGRP;//
        $imo->BKLAS= $request->BKLAS;
        $imo->BSTME=$request->BSTME;
        $imo->VPRSV_1 = $request->VPRSV_1;//
        
       
        $imo->save();
        return redirect()->route('donnes.index')->with('success', 'Data has been saved successfully!');
      

    }
}
