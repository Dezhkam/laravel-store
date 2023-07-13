<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Content\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('admin.content.menu.create',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $menu =  Menu::create($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success','منو شما با موفقیت ایجاد گردید');
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
    public function edit(Menu $menu)
    {
        $menus = Menu::all();
        return view('admin.content.menu.edit',compact('menu','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $menu =  $menu->update($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success','منو شما با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
       $result = $menu->delete();
       return redirect()->route('admin.content.menu.index')->with('swal-success','منو شما با موفقیت حذف گردید');
    }
    public function status(Menu $menu){
        $menu->status = $menu->status==0 ? 1 : 0;
        $result = $menu->save();
        if($result){
            if($menu->status ==0 ){
                return response()->json(['status'=>true,'checked'=>false]);
            }else{
                return response()->json(['status'=>true,'checked'=>true]);
            }
        }else{
            return response()->json(['status'=>false]);
        }
    }
}
