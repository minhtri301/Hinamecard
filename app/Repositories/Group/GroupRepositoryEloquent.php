<?php

namespace App\Repositories\Group;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Group\GroupRepository;
use App\Entities\Group\Group;
use App\Models\Categories;
use App\Validators\Group\GroupValidator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

/**
 * Class GroupRepositoryEloquent.
 *
 * @package namespace App\Repositories\Group;
 */
class GroupRepositoryEloquent extends BaseRepository implements GroupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Group::class;
    }

    public function createGroup($request){
        $data = $request->all(); 
        $data['slug'] = SlugService::createSlug(new Categories(), 'slug', $request->name);
        $data['title'] = json_encode($request->title);
        $data['status'] = $request->status ? 1 : 2;
        $data['users_id'] = Auth::guard('web')->user()->id;
        $cate = Categories::create($data);
        activity('admin-group-create')
        ->causedBy(Auth::user())
        ->performedOn($cate)
        ->withProperties(['ip' => $request->ip()])
        ->log('Thêm nhóm người dùng thành công');

        return true;
    }

    public function updateGroup($request, $id){
        $cate = Categories::find($id); 
        $data = $request->all(); 
        $data['slug'] = SlugService::createSlug($cate, 'slug', $request->name);
        $data['title'] = json_encode($request->title);
        $data['status'] = $request->status ? 1 : 2;
        $cate->update($data);
        activity('admin-group-update')
        ->causedBy(Auth::user())
        ->performedOn($cate)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cập nhật nhóm người dùng thành công');

        return true;
    }

    public function deleteGroup($id){
        activity('admin-group-delete')
        ->causedBy(Auth::user())
        ->performedOn(Categories::find($id))
        ->withProperties(['delete' => $id])
        ->log('Xóa nhóm người dùng thành công');
        Categories::destroy($id);
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
