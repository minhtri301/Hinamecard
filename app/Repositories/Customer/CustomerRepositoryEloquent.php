<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Customer\CustomerRepository;
use App\Validators\Customer\CustomerValidator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;

/**
 * Class CustomerRepositoryEloquent.
 *
 * @package namespace App\Repositories\Customer;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    public function createCustomer($request)
    {
        $data['slug'] = SlugService::createSlug(new Customer(), 'slug', $request->user_name);
        $data['status'] = $request->status ? 1 : 2;
        $data['meta_title'] = $request->name;
        $data['user_name'] = $request->user_name;
        $data['date'] = $request->date;
        $data['group_id'] = $request->group_id;
        $data['login_code'] = $request->login_code;
        $data['login_link'] = $request->login_link;
        $data['image'] = $request->image;
        $data['title'] = $request->title;
        $data['name'] = $request->name;
        
        $customer = Customer::create($data);

        $customer->assignRole($request->role_id);   
        activity('user-create')
        ->causedBy(Auth::user())
        ->performedOn($customer)
        ->withProperties(['ip' => $request->ip()])
        ->log('Thêm mới người dùng thành công');
    }    

    public function updateCustomer($request, $id)
    {
        $customer = Customer::find($id); 
        $data =$request->all();
        if($customer->user_name !== $request->user_name ){
            $data['slug']  = SlugService::createSlug(new Customer(), 'slug', $request->user_name);
        }
        $data['status'] = $request->status ? 1 : 2;
        $data['meta_title'] = $request->name;

        $customer->update($data);

        activity('user-update')
        ->causedBy(Auth::user())
        ->performedOn($customer)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cập nhật người dùng thành công');
    }

    public function deleteCustomer($id){
        activity('user-delete')
        ->causedBy(Auth::user())
        ->performedOn(Customer::find($id))
        ->withProperties(['delete' => $id])
        ->log('Xóa người dùng thành công');
        Customer::destroy($id);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
