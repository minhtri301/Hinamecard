<?php

namespace App\Http\Controllers\Frontend;

use App\Entities\Customer\Customer as CustomerCustomer;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\AppRequest;
use App\Models\Customer;
use App\Models\Customer_has_icon;
use App\Models\Information_icon;
use App\Repositories\PagesSub\PagesSubRepository;
use App\Rules\RegexPhone;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use MicrosoftAzure\Storage\Common\Internal\Validate;

class IndexController extends Controller
{
    protected $pages;

    public function __construct(PagesSubRepository $pages)
    {
        $this->pages = $pages;
        $this->pages->seoGeneral();
    }

    public function index(){
        $this->pages->createSeo();
        $customer = Auth::guard('customer')->user();
        $title = json_decode($customer->group->title);
        return view('frontend.pages.home',compact('customer','title'));
    }

    public function details(){
        $this->pages->createSeo();  
        $customer = Auth::guard('customer')->user();
        $customer_id = Auth::guard('customer')->user()->id;
        $data = Customer_has_icon::where('customer_id',$customer_id)->get();
        $getLink = Information_icon::where('icon_type','link')->get();
        $getBank = Information_icon::where('icon_type','bank')->get();
        $getPhone = Information_icon::where('icon_type','sdt')->get();
        return view('frontend.pages.information', compact('data','getLink','getBank','getPhone','customer'));
    }

    public function loadCard(AppRequest $request){
        $customer_id = Auth::guard('customer')->user()->id;
        $app = Information_icon::find($request->id); 
        if(isset($request->addInput)){
            if($app->icon_type=='link'){
                $validator = Validator::make($request->all(),[
                    'addInput' => 'url'
                 ],[
                    'addInput.url' => 'Đường dẫn không chính xác.'
                 ]);
            };
            if($app->icon_type=='sdt'){
                $validator = Validator::make($request->all(),[
                    'addInput' => new RegexPhone()
                ]);
            }
            if($app->icon_type=='bank'){
                $validator = Validator::make($request->all(),[
                    'addInput' => 'numeric',
                ],[
                    'addInput.numeric' => 'Số tài khoản phải là chữ số',
                ]);
            }
        }
        if(isset($validator)){
            if ($validator->fails())
            {
                return response()->json([
                    'success' => false,
                    'errorMessage'=>$validator->messages()
                ]);
            };
        }
     
        $content = isset($request->addInput) ? $request->addInput : null;
        $customerIcon = Customer_has_icon::create([
            'customer_id' => $customer_id, 
            'card_id' => $request->id, 
            'content' => $content,
        ]);

        activity('home-card-create')
        ->causedBy(Auth::guard('customer')->user())
        ->performedOn($customerIcon)
        ->withProperties(['ip' => $request->ip()])
        ->log('Đã thêm ứng dụng thành công');

        $data = Customer_has_icon::where('customer_id',$customer_id)->get();
        $card_html = View::make('frontend.ajax.get-load-card-ajax',compact('data'))->render();
        return response()->json([
            'success' => 'success',
            'message' => 'Thêm thành công',
            'html' => $card_html,
        ]);
    }

    public function editCard($id){
        $data = Customer_has_icon::find($id); 
        $card_edit_html = View::make('frontend.ajax.get-edit-card-ajax',compact('data'))->render();
        return response()->json([
            'html' => $card_edit_html,
        ]);
    }

    public function updateCard(Request $request){
        
        $customerCard = Customer_has_icon::find($request->id); 
        if(isset($request->content)){

            if($customerCard->infor_icon->icon_type=='link'){
                $validator = Validator::make($request->all(),[
                     'content' => 'url'
                 ],[
                     'content.url' => 'Đường dẫn không chính xác.'
                 ]);
            };

            if($customerCard->infor_icon->icon_type=='sdt'){
                $validator = Validator::make($request->all(),[
                    'content' => new RegexPhone()
                ]);
            }

            if($customerCard->infor_icon->icon_type=='bank'){
                $validator = Validator::make($request->all(),[
                    'content' => 'numeric',
                ],[
                    'content.numeric' => 'Số tài khoản phải là chữ số',
                ]);
            }
        }
        if(isset($validator)){
            if ($validator->fails())
            {
                return response()->json([
                    'success' => false,
                    'errorMessage'=>$validator->messages()
                ]);
            };
        }
        $customerCard->update([
            'content' => $request->content,
        ]);
        
        activity('home-card-update')
        ->causedBy(Auth::guard('customer')->user())
        ->performedOn($customerCard)
        ->withProperties(['ip' => $request->ip()])
        ->log('Đã cập nhật ứng dụng thành công');

        $customer_id = Auth::guard('customer')->user()->id;
        $data = Customer_has_icon::where('customer_id',$customer_id)->get();
        $card_html = View::make('frontend.ajax.get-load-card-ajax',compact('data'))->render();
        return response()->json([
            'success' => 'success',
            'message' => 'Thay đổi thành công',
            'html' => $card_html,
        ]);
    }

    public function deleteCard($id){
        activity('home-card-delete')
        ->causedBy(Auth::guard('customer')->user())
        ->performedOn(Customer_has_icon::find($id))
        ->withProperties(['delete' => $id])
        ->log('Đã xóa ứng dụng thành công');

        Customer_has_icon::destroy($id); 
        $customer_id = Auth::guard('customer')->user()->id;
        $data = Customer_has_icon::where('customer_id',$customer_id)->get();
        $card_edit_html = View::make('frontend.ajax.get-load-card-ajax',compact('data'))->render();
        return response()->json([
            'success' => 'success',
            'message' => 'Đã xóa thành công',
            'html' => $card_edit_html,
        ]);
    }

    public function update(Request $request){
        $customer_id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($customer_id); 
        $data = $request->all();
        if($request->file('image')){
            $get_image = $customer->image;
            File::delete(public_path($get_image));
            $image = $request->file('image');
            $customer_image = $image->getClientOriginalName();
            $destinationPath = public_path('/ckfinder/uploads/images/Admin/Image-customer');
            $image->move($destinationPath,$customer_image);
            $data['image'] = '/ckfinder/uploads/images/Admin/Image-customer/'.$customer_image;
        }else{
            $data['image'] = $customer->image;
        }
        // dd($request->phone);
        $customer->update($data);

        activity('home-information-update')
        ->causedBy(Auth::guard('customer')->user())
        ->performedOn($customer)
        ->withProperties(['ip' => $request->ip()])
        ->log('Cập nhật thông tin thành công');
        
        return redirect()->route('home.page.index')->with('success','Cập nhật thành công');
    }

    public function preview(){ 
        $this->pages->createSeo();
        $customer = Auth::guard('customer')->user();
        $title = json_decode($customer->group->title);
        $data = Customer_has_icon::where('customer_id',$customer->id)->get();
        return view('frontend.pages.preview',compact('data','customer','title'));
    }

    public function getIconPreview(Request $request){
        $customer = Customer::where('slug',$request->slug)->first(); 
        $data = Information_icon::where('id',$request->id)->where('customer_id',$customer->id)->first(); 
        $html = view::make('frontend.ajax.get-preview-icon-ajax',compact('data'))->render(); 
        return response()->json([
            'html' => $html,
        ]);
    }

    public function shareCard($slug){
        $customer = Customer::where('slug',$slug)->first();
        $this->pages->createSeo($customer);
        if(isset($customer)){
            $title = json_decode($customer->group->title);
            $data = Customer_has_icon::where('customer_id',$customer->id)->get();
            return view('frontend.pages.share-card',compact('data','customer','title'));
        }
    }

    public function card_update_position(){

    }
}
