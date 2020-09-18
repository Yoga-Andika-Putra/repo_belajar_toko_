<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product; 
use Illuminate\Support\Facades\Validator; 

 class ProductController extends Controller 
{ 
    public function show() 
    { 
            return Product::all(); 
    } 
    
    public function detail($id) 
    {         if(Product::where('id', $id)->exists()) { 
        $data_product = Product::where('id',$id)->get();
        return Response()->json($data_product);  
        }         
        else 
        { 
        return Response()->json(['message' => 'Data Tidak ditemukan' ]); 
        } 
    } 

    public function store(Request $request) 
    { 
        $validator=Validator::make($request->all(),             [ 
                'nama_product' => 'required', 
                'harga' => 'required', 
                'stok' => 'required'
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $simpan = Product::create(
        [ 
            'nama_product' => $request->nama_product, 
            'harga' => $request->harga,
            'stok' => $request->stok
        ]); 
         if($simpan) {             
            return Response()->json(['message' => 'Data berhasil di tambah' ]); 
        }
        else {             
            return Response()->json(['message' => 'Data gagal di tambah' ]); 
        } 
    } 
 
    public function update($id, Request $request)     
    { 
        $validator=Validator::make($request->all(), 
            [ 
                'nama_product' => 'required', 
                'harga' => 'required', 
                'stok' => 'required' 
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $ubah = Product::where('id', $id)->update([ 
            'nama_product' => $request->nama_product, 
            'harga' => $request->harga,
            'stok' => $request->stok
        ]); 
 
        if($ubah) { 
            return Response()->json(['message' => 'Data berhasil di ubah' ]); 
        }         else { 
            return Response()->json(['message' => 'Data gagal di ubah' ]);
        } 
    } 

    
    public function destroy($id) 
    { 
        $hapus = Product::where('id', $id)->delete();
        if($hapus) {             
            return Response()->json(['message' => 'Data berhasil di hapus' ]); 
        }         
        else {             
            return Response()->json(['message' => 'Data tidak berhasil di hapus' ]);         } 
    }
} 