<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    public $table = "barang";
	
    protected $primaryKey = 'kodebarang';
    
    protected $filable = [
        'nama','jumlah','harga'
    ];
}
