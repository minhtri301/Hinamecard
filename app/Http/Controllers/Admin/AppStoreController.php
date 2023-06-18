<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppRequest;
use App\Models\Customer_has_icon;
use App\Models\Information_icon;
use App\Repositories\InformationIcon\InformationIconRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppStoreController extends Controller
{
    protected $_inforIcon; 

    public function __construct(InformationIconRepository $inforIco)
    {
        $this->_inforIcon = $inforIco;
        $this->middleware(['role_or_permission:Chủ sở hữu|app']);
    }

    public function index(Request $request){
        $data = $this->_inforIcon;
        if($request->key){
            $data = $data->where('icon_name','like',"%{$request->key}%");
        }
        $data = $data->orderBy('id','desc')->get();
        return view('admin.appStore.index', compact('data'));
    }

    public function edit($id){
        $data = Information_icon::find($id); 
        $html = view::make('admin.ajax.get-modal-edit-app', compact('data'))->render(); 
        return response()->json([
            'html' => $html,
        ]);
    }

    public function store(AppRequest $request){
        $this->_inforIcon->createApp($request);
        return back()->with('success','Thêm thành công');
    }

    public function update(Request $request){
        $this->_inforIcon->updateApp($request); 
        return back()->with('success','Cập nhật thành công');
    }

    public function delete($id){
        $this->_inforIcon->deleteApp($id);
        return back()->with('success','Xóa thành công');
    }
}
