<?php

namespace App\Entities\InformationIcon;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InformationIcon.
 *
 * @package namespace App\Entities\InformationIcon;
 */
class InformationIcon extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
