<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categories;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use PHPUnit\TextUI\XmlConfiguration\Group;

class Livewire extends Component
{
    // public $Categories, $name, $phone, $from_date, $image, $title, $latitud, $status, $firstday;
    public $inputs = [];
    public $i = 1;
    public $array;
    public $allTitleCate = []; 
    public $titleCate = []; 

    public function mount(){
        $this->allTitleCate = Categories::all(); 
        $this->titleCate = [ 
            ['title' => '']
        ];
    }
    public function addCate(){
        $this->titleCate[] = ['title' => ''];
    }
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }
    public function removeGroup($key){
        unset($this->inputs[$key]);
        $this->inputs = array_values($this->inputs);
    }
  public function render()
    {
        info($this->inputs); 
        return view('livewire.livewire');
    }



    
    // public function render()
    // {
    //     return view('livewire.livewire');
    // }
    // private function resetInputFields(){
    //     $this->name = '';
    //     $this->phone = '';
    //     $this->from_date = '';   
    //     $this->image = ''; 
    //     $this->title = '';
    //     $this->status = '';
    //     $this->latitud = '';
    // }
    // public function store(){
    //     $validatedDate = $this->validate([
    //             'name' => 'required',
    //             'from_date' => 'required', 
    //             'image' => 'required',
    //             'title.1' => 'required',
    //             'title.*' => 'required',
    //             'status' => 'required',
    //         ],
    //         [
    //             'name.required' => 'Vui lòng nhập tên nhóm',
    //             'from_date.required' => 'Vui lòng chọn ngày',
    //             'image.required' => 'Vui lòng chọn ảnh', 
    //             'title.1.required' => 'Vui lòng nhập mô tả',
    //             'title.*.required' => 'Vui lòng nhập mô tả',
    //             'status.required' => 'Vui lòng chọn',
    //         ]
    //     );
    //     $cate = new Categories();
    //     $data['name'] = $this->name;
    //     $data['slug'] = SlugService::createSlug($cate, 'slug', $this->name);
    //     $data['date'] = $this->from_date;
    //     $data['image'] = $this->latitud;
    //     $data['status'] = $this->status = true ? 1 : 0;
    //     $data['title'] = json_encode($this->title);
    //     Categories::create($data);  

    //     $this->resetInputFields(); 
    //     session()->flash('message', 'Group Management Has Been Created Successfully.');
      
    // }

}
