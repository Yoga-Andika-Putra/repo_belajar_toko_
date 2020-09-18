<?php  
namespace App; 
 use Illuminate\Database\Eloquent\Model; 
 class Customers extends Model 
{     protected $table = 'customers';     public $timestamps = false; 
 
    protected $fillable = ['nama_customers', 'telepon','alamat']; 
} 