@extends('admin.layouts.master')

@section('head-tag')
    <title>ویرایش منو</title>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"> <a href="#">منو</a></li>
            <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش منو</li>
        </ol>
    </nav>


    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        ویرایش منو
                    </h5>
                </section>

                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.menu.update',$menu->id) }}" method="post" id="form">
                        @csrf
                        @method("PUT")
                        <section class="row">

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">عنوان منو</label>
                                    <input name="name" type="text" class="form-control form-control-sm"
                                        value="{{ old('name',$menu->name) }}">
                                </div>
                                @error('name')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">منو والد</label>
                                    <select name="parent_id" id="" class="form-control form-control-sm">
                                        {{-- <option value="">والد را انتخاب کنید</option> --}}
                                        @foreach ($menus as $mnu)
                                            @if ($mnu->id != $menu->id)
                                                <option value="{{ $mnu->id }}" @if ($mnu->id == old('parent_id',$menu->parent_id))
                                                    selected
                                                @endif>{{ $mnu->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="">آدرس URL</label>
                                    <input name="url" type="text" class="form-control form-control-sm"
                                        value="{{ old('url',$menu->url) }}">
                                </div>
                                @error('url')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm"
                                        id="status">
                                        <option value="0" @if (old('status',$menu->status) == 0) selected @endif>غیرفعال
                                        </option>
                                        <option value="1" @if (old('status',$menu->status) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </section>

                            <section class="col-12 mt-2">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>

            </section>
        </section>
    </section>
@endsection
