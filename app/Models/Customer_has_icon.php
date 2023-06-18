<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_has_icon extends Model
{
    use HasFactory;
    
    protected $table = 'customer_has_icon';

    protected $guarded = [];

    public function infor_icon(){
        return $this->hasOne(\App\models\Information_icon::class, 'id', 'card_id');
    }

    public function customer(){
        return $this->hasOne(\App\models\Customer::class, 'id', 'customer_id');
    }
}
