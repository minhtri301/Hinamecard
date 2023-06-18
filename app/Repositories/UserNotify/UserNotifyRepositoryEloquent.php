<?php

namespace App\Repositories\UserNotify;

use App\Models\UserNotify;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Validators\UserNotify\UserNotifyValidator;
use App\Repositories\UserNotify\UserNotifyRepository;

/**
 * Class UserNotifyRepositoryEloquent.
 *
 * @package namespace App\Repositories\UserNotify;
 */
class UserNotifyRepositoryEloquent extends BaseRepository implements UserNotifyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserNotify::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
