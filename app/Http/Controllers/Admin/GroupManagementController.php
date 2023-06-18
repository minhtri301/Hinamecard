<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GroupManagementRequest;
use App\Repositories\Group\GroupRepository;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Laravel\Ui\Presets\React;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class GroupManagementController extends Controller
{
    protected $_group;

    public function __construct(GroupRepository $group)
    {
        $this->_group = $group;
        $this->middleware(['role_or_permission:Chủ sở hữu|group']);
    }

    public function index(Request $request)
    {
        $today = date('Y/m/d');
        $data = DB::table('Categories');
        $check = $request->check;
        if($check){    
            $data = $data->where('name','like', "%{$request->key}%")->where('status',$check);   
        }else{
            $data = $data->where('name','like', "%{$request->key}%");   
        };
        $data = $data->orderBy('id','desc')->get();    
        return view('admin.groupManagement.index', compact('data','today'));
    }

    public function getGroupEdit($id){
        $data = Categories::find($id); 
        $name = $data->name;
        $date = $data->date;
        $image = $data->image;
        $title = $data->title;
        $status = $data->status;
        $image_render = View::make('admin.ajax.get-edit-group', compact('title','image','status'))->render();
        return response()->json([
            'image' => $image_render,
           'datas' => $data,
            'url' => route('post.group.edit',$id)
        ]);
    }

    public function postGroupEdit(GroupManagementRequest $request, $id){
        $this->_group->updateGroup($request, $id);
        return back()->with('success','Cập nhật thành công');
    }

    public function deleteGroup($id){
        $this->_group->deleteGroup($id);
        return back()->with('success','Xóa thành công thành công');
    }


    public function create(){
        return view('admin.groupManagement.create');
    }
    
    public function store(Request $request){
        $this->_group->createGroup($request);
        return back()->with('success','Thêm thành công');
    }
}
