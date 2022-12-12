<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;


class VendorInvoice extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'vendor_invoice';

    protected $id = '_id';

    protected $fillable = [
        'invoice_no',
        'invoice_attachment',
        'supporting_document',
        'instruction_id',
    ];
}