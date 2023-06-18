<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use Aws\Api\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use MicrosoftAzure\Storage\Common\Internal\Validate;
use Spatie\Permission\Models\Role;

class AdminManagementController extends Controller
{
    protected $_user;

    public function __construct(UserRepository $user)
    {
		$this->_user = $user;
        $this->middleware(['role_or_permission:Chủ sở hữu|admin']);
    }

    public function index(Request $request)
    {
        $data = $this->_user;
        if($request->status){
            $data = $data->where('status',$request->status);
        }
        if($request->keyword){
            $data = $data->where('user_name','like',"%{$request->keyword}%");
        }
        $data = $data->orderBy('id','desc')->get(); 
        $cate = Categories::all();
        return view('admin.users.index', compact('data','cate'));  
    }
    
    public function update(AdminUpdateRequest $request, $id){
        $this->_user->updateAdmin($request, $id);
        return redirect()->route('managementAdmin.index')->with('success','Cập nhật thành công');
    }

    public function create(){ 
        $today = date('Y/m/d');
        $role = Role::where('id','!=',3)->get();
        return view('admin.users.create' , compact('today','role'));
    }

    public function store(AdminRequest $request){
        $this->_user->createAdmin($request);
        return redirect()->route('managementAdmin.index')->with('success','Thêm mới thành công');
    }

    public function delete($id){
        $this->_user->deleteAdmin($id);
        return back()->with('success','Xóa thành công');
    }

    public function edit($id){
        $role = Role::where('id','!=',3)->get();
        $Cate = Categories::all();
        $data = User::find($id);
        return view('admin.users.edit',compact('data','Cate','role'));
     
    }

}
