<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders; 
use Illuminate\Support\Facades\Validator; 

 class OrdersController extends Controller 
{ 
    public function show() 
    { 
        $data_orders = Orders::join('customers', 'orders.id_customers', 'customers.id')
                                ->join('product', 'orders.id_product', 'product.id')
                                ->select('orders.id_orders','customers.nama_customers',
                                         'customers.telepon','customers.alamat',
                                         'product.nama_product','product.harga')
                                ->get();         
        return Response()->json($data_orders); 
    }

    
     
    public function detail($id_orders) 
    {         if(Orders::where('id_orders', $id_orders)->exists()) { 
        $data_orders=Orders::where('id_orders',$id_orders)->get();         
        return Response()->json($data_orders);   
        }         
        else 
        { 
        return Response()->json(['message' => 'Data Tidak ditemukan' ]); 
        } 
    }     
    public function store(Request $request) 
    { 
        $validator=Validator::make($request->all(),             
            [ 
                
                'id_product' => 'required', 
                'id_customers' => 'required' 
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $simpan = Orders::create([ 
            
            'id_product' => $request->id_product, 
            'id_customers' => $request->id_customers 
        ]); 
         if($simpan) {             
            return Response()->json(['message' => 'Data berhasil di tambah' ]); 
        }
        else {             
            return Response()->json(['message' => 'Data gagal di tambah' ]); 
        } 
    } 

    public function update($id_orders, Request $request)     { 
        $validator=Validator::make($request->all(), 
            [ 
                
                'id_product' => 'required', 
                'id_customers' => 'required' 
            ] 
        ); 
         if($validator->fails()) {             
             return Response()->json($validator->errors());         } 
 
        $ubah = Orders::where('id_orders',$id_orders)->update([ 
            
            'id_product' => $request->id_product, 
            'id_customers' => $request->id_customers
        ]); 
 
        if($ubah) { 
            return Response()->json(['message' => 'Data berhasil di ubah' ]); 
        }         
        else 
        { 
            return Response()->json(['message' => 'Data gagal di ubah' ]);
        } 
    } 

    
    public function destroy($id_orders) 
    { 
        $hapus = Orders::where('id_orders', $id_orders)->delete();
        if($hapus) {             
            return Response()->json(['message' => 'Data berhasil di hapus' ]); 
        }         
        else {             
            return Response()->json(['message' => 'Data tidak berhasil di hapus' ]); 
        } 
    }
} 