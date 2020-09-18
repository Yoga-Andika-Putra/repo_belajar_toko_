<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customers; 
use Illuminate\Support\Facades\Validator; 

 class CustomersController extends Controller 
{ 

    public function show() 
    { 
            return Customers::all(); 
    } 


    public function detail($id) 
    {         if(Customers::where('id', $id)->exists()) { 
        $data_customers = Customers::where('id',$id)->get();
        return Response()->json($data_customers);  
        }         
        else 
        { 
        return Response()->json(['message' => 'Data Tidak ditemukan' ]); 
        } 
    } 

    public function store(Request $request) 
    { 
        $validator=Validator::make($request->all(),             [ 
                'nama_customers' => 'required',
                'telepon' => 'required',
                'alamat' => 'required' 
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $simpan = Customers::create([ 
            'nama_customers' => $request->nama_customers,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]); 
         if($simpan) {             
            return Response()->json(['message' => 'Data berhasil di tambah' ]); 
        }
        else {             
            return Response()->json(['message' => 'Data gagal di tambah' ]); 
        } 
    } 

    public function update($id, Request $request)     { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_customers' => 'required',
                'telepon' => 'required',
                'alamat' => 'required'
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $ubah = Customers::where('id', $id)->update([ 
            'nama_customers' => $request->nama_customers,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat
        ]); 
 
        if($ubah) { 
            return Response()->json(['message' => 'Data berhasil di ubah' ]); 
        }         else { 
            return Response()->json(['message' => 'Data gagal di ubah' ]);
        } 
    } 


    public function destroy($id) 
    { 
        $hapus = Customers::where('id', $id)->delete();
        if($hapus) {             
            return Response()->json(['message' => 'Data berhasil di hapus' ]); 
        }         
        else {             
            return Response()->json(['message' => 'Data tidak berhasil di hapus' ]); 
        } 
    }
 
} 
