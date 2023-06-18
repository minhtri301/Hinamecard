<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information_icon extends Model
{
    use HasFactory;

    protected $table = 'information_icon';

    protected $guarded = [];

    public function customericon(){
        return $this->hasMany(\App\models\Customer_has_icon::class, 'card_id', 'id');
    }
}
