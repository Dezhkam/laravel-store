<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductCategory;
use App\Models\Market\CategoryAttribute;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryAttributes = CategoryAttribute::all();
        return view('admin.market.property.index',compact('categoryAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.create',compact('productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        $attribute = CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', ' فرم جدید شما با موفقیت ثبت شد');
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
    public function edit(CategoryAttribute $categoryAttribute)
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.edit',compact('categoryAttribute','productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryAttributeRequest $request,CategoryAttribute $CategoryAttribute)
    {
        $inputs = $request->all();
        $attribute = $CategoryAttribute->update($inputs);
        return redirect()->route('admin.market.property.index')->with('swal-success', ' فرم شما با موفقیت ویرایش شد'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAttribute $categoryAttribute)
    {
       $result = $categoryAttribute->delete();
       return redirect()->route('admin.market.property.index')->with('swal-success','  فرم شما با موفقیت حذف گردید');
    }
}
