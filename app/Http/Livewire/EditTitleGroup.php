<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categories;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use PHPUnit\TextUI\XmlConfiguration\Group;

class EditTitleGroup extends Component
{
      // public $Categories, $name, $phone, $from_date, $image, $title, $latitud, $status, $firstday;
      public $inputs = [];
      public $i = 1;
      public $array;
      public $allTitleCate = []; 
      public $titleCate = []; 
      public $url;

      public function render()
      {
        if(Request()->id !== null){
            $array = json_decode(Categories::find(Request()->id)->title); 
            foreach($array as $key => $item){
               $this->inputs[] = $item;
            }
            $this->array = '';
        }
        info($this->inputs); 
          return view('livewire.edit-title-group');
      }
      public function load(){
           $array = json_decode(Categories::find(Request()->id)->title); 
          foreach($array as $key => $item){
             $this->inputs[] = $item;
          }
      }
      public function mount(){
        // if(Request()->id !== null){
        //     $array = json_decode(Categories::find(Request()->id)->title); 
        //     foreach($array as $key => $item){
        //         $this->inputs[] = $item;
        //     }
        //     $this->array = '';
        // }
          
        //   dd($this->inputs);
        //   $this->titleCate = [ 
        //       ['title' => '']
        //   ];
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
   
}
