<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Instruction extends Eloquent
{
    use HasFactory;
    
    protected $table = 'instruction';

    protected $id = '_id';

    protected $fillable = [
        'instruction_id',
        'link_to',
        'instruction_type',
        'assigned_vendor',
        'attention_of',
        'quotation_no',
        'customer_po',
        'status',
        'cost_detail',
        'attachment',
        'note',
        'link_to',
        'vendor_invoice'
    ];
}