<?php

namespace App\Repositories\InformationIcon;

use App\Models\Customer_has_icon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InformationIcon\InformationIconRepository;
use App\Models\Information_icon;
use App\Validators\InformationIcon\InformationIconValidator;
use Illuminate\Support\Facades\Auth;

/**
 * Class InformationIconRepositoryEloquent.
 *
 * @package namespace App\Repositories\InformationIcon;
 */
class InformationIconRepositoryEloquent extends BaseRepository implements InformationIconRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Information_icon::class;
    }

    public function createApp($request){
        $data = $request->all(); 
        $app = Information_icon::create($data);
        activity('admin-app-create')
        ->causedBy(Auth::user())
        ->performedOn($app)
        ->withProperties(['ip' => $request->ip()])
        ->log('Thêm mới ứng dụng thành công');

        return true;
    }

    public function updateApp($request){
        $data = $request->all();
        $infor = Information_icon::find($request->id); 
        $infor->update($data); 
        activity('admin-app-update')
        ->causedBy(Auth::user())
        ->performedOn($infor)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cập nhật ứng dụng thành công');

        return true;
    }

    public function deleteApp($id){
        $data = Customer_has_icon::where('card_id',$id)->get(); 
        if(!empty($data)){
            foreach($data as $item){
                Customer_has_icon::destroy($item->id);
            }
        }
        activity('admin-app-delete')
        ->causedBy(Auth::user())
        ->performedOn(Information_icon::find($id))
        ->withProperties(['deleteIcon' => $id])
        ->log('Xóa ứng dụng thành công');
        Information_icon::destroy($id);

        return true;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
