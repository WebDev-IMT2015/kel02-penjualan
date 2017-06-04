<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    public $table = "invoice";
	    
    protected $filable = [
        'kodeinvoice','nama','tanggal','kodebarang','jumlah'
    ];
}
