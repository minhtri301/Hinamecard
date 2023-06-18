<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Customer extends Authenticatable
{
    use HasFactory, Sluggable, HasRoles;

    protected $table = 'customer';

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user_name'
            ]
        ];
    }

    public function group(){
        return $this->hasOne(\App\models\Categories::class, 'id', 'group_id');
    }
    
}
