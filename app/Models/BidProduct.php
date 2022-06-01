<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidProduct extends Model
{
    protected $fallible = [ 'bid_product_id', 'bid_product_buyer_id', 'bid_price' ];
    use HasFactory;
}
