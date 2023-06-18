<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Validators\User\UserValidator;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\User;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function createAdmin($request){
        $data = $request->all(); 
        $data['status'] = $request->status ? 1 : 0;
        $data['password'] = hash::make($request->password);
        $user = User::create($data);

        $user->assignRole($request->role_id); 
        activity('admin-create')
        ->causedBy(Auth::user())
        ->performedOn($user)
        ->withProperties(['ip' => $request->ip()])
        ->log('Thêm mới Admin thành công');

        return true;
    }

    public function updateAdmin($request, $id){
        $customer = User::find($id);  
        $data = $request->all();
        $data['status'] = $request->status ? 1 : 2;
        $data['password'] = $customer->password;

        if($request->password || $request->repassword){
            $request->validate([
                'password'      => 'required|min:8',
                'repassword'    => 'required|same:password'
            ],[
                'password.required' => 'Vui lòng điền mật khẩu.',
                'password.min' => 'Mật khẩu ít hơn 8 ký tự.',
                'repassword.required' => 'Vui lòng điền lại mật khẩu.', 
                'repassword.same' => 'Mật khẩu không khớp',
            ]);
            $data['password'] = hash::make($request->password);
        };

        $customer->removeRole($customer->roles->pluck('id')->first()); 

        $customer->update($data);

        $customer->assignRole($request->role_id); 

        activity('admin-update')
        ->causedBy(Auth::user())
        ->performedOn($customer)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cập nhật Admin thành công');

        return true;
    }

    public function deleteAdmin($id){
        activity('admin-delete')
        ->causedBy(Auth::user())
        ->performedOn(User::find($id))
        ->withProperties(['delete' => $id])
        ->log('Xóa Admin thành công');
        User::destroy($id);
        
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
