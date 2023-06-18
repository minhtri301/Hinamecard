<?php

namespace App\Http\Controllers\Admin;

use App\Models\PageSub;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PagesSubController extends Controller
{
        public function __construct()
        {
                $this->middleware(['role_or_permission:Chủ sở hữu|pages']);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = PageSub::all();
            return view('admin.pages-sub.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('admin.pages-sub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $input = $request->all();

            $input['slug'] = SlugService::createSlug(PageSub::class, 'slug', $request->slug);

            PageSub::create($input);

            return redirect()->route('page-sub.index')->with('success','Thêm mới thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $data = PageSub::findOrFail($id);
            return view('admin.pages-sub.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $data = PageSub::findOrFail($id);

            $input = $request->all();

            if($data->name_page != $request->name_page){
                $input['slug'] = SlugService::createSlug(PageSub::class, 'slug', $request->slug);
            }

            $data->update($input);

            return redirect()->route('page-sub.index')->with('success','Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            PageSub::destroy($id);
            return back()->with('success','Xóa thành công');
    }
}
