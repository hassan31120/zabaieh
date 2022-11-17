@extends('admin.layouts.main')

@section('dash')
    المنتجات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px">تعديل المنتج</h5>
                        </div>
                        <div class="col-6" style="position: relative;"><a href="{{ route('admin.products') }}"
                                style="position: absolute; left: 2%" class="btn btn-primary">عرض المنتجات</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class=" container-fluid">
                            <!--form section-->
                            <section class="vh-100 gradient-custom sectionFormDIR">
                                <div class="container py-5 h-100">
                                    <div class="row justify-content-center align-items-center h-100">
                                        <div class="col-12 col-lg-9 col-xl-7">
                                            <div class="card shadow-2-strong card-registration"
                                                style="border-radius: 15px;">
                                                <div class="card-body p-4 p-md-5">
                                                    <form action="{{ route('admin.product.update', $product->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="name"
                                                                        style="font-size: 18px">الإسم</label>
                                                                    <input type="text" name="name" id="name"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        required value="{{ $product->name }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="description"
                                                                        style="font-size: 18px">الوزن</label>
                                                                        <input type="text" name="weight" id="weight"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        required value="{{ $product->weight }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="old_price"
                                                                        style="font-size: 18px">السعر القديم</label>
                                                                    <input type="number" name="old_price" id="old_price"
                                                                        step=".01"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        required value="{{ $product->old_price }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="new_price"
                                                                        style="font-size: 18px">السعر الجديد</label>
                                                                    <input type="number" name="new_price" id="new_price"
                                                                        step=".01"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        required value="{{ $product->new_price }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <div class="form-outline">
                                                                    <label class="form-label" for="image"
                                                                        style="font-size: 18px">الصورة</label>
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <img src="{{ asset($product->image) }}"
                                                                                class="img-thumbnail" alt="product image">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <input type="file" name="image"
                                                                                id="image"
                                                                                class="form-control form-control-lg formborderCSS" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group mx-sm-3 mb-2">
                                                                    <label class="form-label" for="cat_id"
                                                                        style="font-size: 18px">اختيار قسم - شركة</label>
                                                                    <select name="cat_id" id="cat_id"
                                                                        class="form-control form-control-lg formborderCSS"
                                                                        class="form-control" required>
                                                                        @foreach ($cats as $cat)
                                                                            <option value="{{ $cat->id }}"
                                                                                {{ isset($product) ? ($product->cat_id == $cat->id ? 'selected' : '') : old('cat_id') }}>
                                                                                {{ $cat->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-4 pt-2 text-center">
                                                            <input class="btn btn-primary btn-lg" type="submit"
                                                                value="تعديل" />
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--endform section-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
