<?php

namespace App\Http\Controllers\Admin;


use App\Models\Categories;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\CustomerRequest;
use Spatie\Permission\Models\Role;

class ManagementController extends Controller
{
    protected $_customer;

    public function __construct(CustomerRepository $customer)
    {
		$this->_customer = $customer;
        $this->middleware(['role_or_permission:Chủ sở hữu|customer']);
    }

    public function index(Request $request)
    {
        $data = $this->_customer;
        if($request->group_id){
            $data = $data->where('group_id',$request->group_id); 
        }
        if($request->status){
            $data = $data->where('status',$request->status);
        }
        if($request->keyword){
            $data = $data->where('user_name','like',"%{$request->keyword}%");
        }
        $data = $data->orderBy('id','desc')->get(); 
        $cate = Categories::all();
        return view('admin.management.index', compact('data','cate'));
    }

    public function create(Request $request)
    {  
        $string = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i = 1; $i <= 6; $i++) {
            $position = rand() % strlen($chars);
            $string .= substr($chars, $position, 1).'-';
        }
        $string = substr($string,0,-1);
        $Cate = Categories::all();
        $today = date('Y/m/d');
        $roles = Role::find(3);
        return view('admin.management.create' , compact('today','Cate','string','roles'));
    }

    public function store(CustomerRequest $request){ 
        $this->_customer->createCustomer($request);      
        return redirect()->route('management.index')->with('success','Thêm thành công');
    }

    public function update(CustomerRequest $request, $id){
        $this->_customer->updateCustomer($request, $id);
        return redirect()->route('management.index')->with('success','Cập nhật thành công');
    }

    public function delete($id){
        $this->_customer->deleteCustomer($id);
        return back()->with('success','Xóa thành công');
    }
  
    public function edit($id){
        $Cate = Categories::all();
        $data = Customer::find($id);
        $roles = Role::find(3);
        return view('admin.management.edit',compact('data','Cate','roles'));
    }

    public function reloadCode(){
        $string = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i = 1; $i <= 6; $i++) {
            $position = rand() % strlen($chars);
            $string .= substr($chars, $position, 1).'-';
        }
        $string = substr($string,0,-1);
        return response()->json([
            'string' => $string,
        ]);
    }
}
