<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['member_id', 'payment_date', 'amount', 'total_weeks', 'total_amount', 'total_payment', 'total_due'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    protected $casts = [
        'payment_date' => 'datetime',
    ];
}
