<?php

namespace App\Models\Market;

use App\Models\Market\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashPayment extends Model
{
    use HasFactory;

    public function payments(){
        return $this->morphMany(Payment::class,'paymentable');
    }
}
