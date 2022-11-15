<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class VendorInvoice extends Eloquent
{
    use HasFactory;

    protected $table = 'vendor_invoice';

    protected $id = '_id';

    protected $fillable = [
        'invoice_no',
        'invoice_attachment',
        'supporting_document',
        'instruction_id',
    ];
}
