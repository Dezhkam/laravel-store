<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Services\Image\ImageCacheService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Content\PostCategory;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Content\PostCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $imageCache = new ImageCacheService();
        // return $imageCache->cache('public/1.png');
        return view('admin.content.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['slug'] = str_replace(' ','-',$inputs['name']) . '-' . Str::random(5);
        if($request->hasFile('image')){
            $imageService = new ImageService();
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            // $result = $imageService->save($request->file('image'));
            // $result = $imageService->fitAndSave($request->file('image'));
            $result = $imageService->createIndexAndSave($request->file('image'));
        }
        if($result===false){
            return redirect()->route('admin.content.category.index')->with('swal-error','آپلود تصویر با خطا مواحه شد')->with('toast-success','دسته بندی شما با موفقیت ایجاد گردید');
        }
        $inputs['image'] = $result;
        $postCategory =  PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی شما با موفقیت ایجاد گردید');
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
    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit',compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs = $request->all();
        if($request->hasFile('image')){
            $imageService = new ImageService();
             if(!empty($postCategory->image)){
                $imageService->deleteDirectoryAndFiles($postCategory->image['directory']);
            }
            
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post-category');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if($result===false){
                return redirect()->route('admin.content.category.index')->with('swal-error','آپلود تصویر با خطا مواحه شد')->with('toast-success','دسته بندی شما با موفقیت ایجاد گردید')->with('alert-section-success','آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }else{
            if(isset($inputs['currentImage']) && !empty($postCategory->image)){
                $image = $postCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $postCategory =  $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی شما با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
       $result = $postCategory->delete();
       return redirect()->route('admin.content.category.index')->with('swal-success','دسته بندی شما با موفقیت حذف گردید');
    }
    public function status(PostCategory $postCategory){
        $postCategory->status = $postCategory->status==0 ? 1 : 0;
        $result = $postCategory->save();
        if($result){
            if($postCategory->status ==0 ){
                return response()->json(['status'=>true,'checked'=>false]);
            }else{
                return response()->json(['status'=>true,'checked'=>true]);
            }
        }else{
            return response()->json(['status'=>false]);
        }
    }
}
