@extends('admin.layouts.main')

@section('dash')
الطلبيات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">جدول
                                الطلبيات المرفوضة</h5>
                        </div>
                        <div class="col-6" style="position: relative;">
                            <div style="position: absolute; left: 2%">
                                <a href="{{ route('admin.orders.accepted') }}" class="btn btn-primary" style="margin-left: 10px">الموافقات</a>
                                <a href="{{ route('admin.orders') }}" class="btn btn-primary">المعلقة</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        @if (count($orders) > 0)
                            <table class="table align-items-center mb-0" style="overflow: hidden; ">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th> --}}
                                        <th class="text-secondary font-weight-bolder opacity-7">الإسم
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            الرقم</th>

                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            منذ</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            العنوان</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            السعر</th>
                                            <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            الحالة</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تفاصيل الطلب</th>
                                        <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                            تعليق  </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $order->user->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order->user->number }}</p>
                                            </td>


                                            <td class="align-middle text-center">

                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $order->created_at->diffForHumans() }}</span>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $order->address->description }}</p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $order->product->new_price }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-center">
                                                    {{ $order->status }}
                                                </p>
                                            </td>

                                            <td>
                                                <p class="text-center" style="margin-top: 30px">
                                                    <a href="{{ route('admin.order.details', $order->id) }}"
                                                        class="btn btn-info"> التفاصيل </a>
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center" style="margin-top: 30px:">
                                                    <form action="{{ route('order.status', $order->id) }}" method="POST"
                                                        class="text-center">
                                                        @csrf
                                                        <span class="tick-circle mr-5">
                                                            <input type="hidden" name="status" value="Pending">
                                                            <input type="submit" value="تعليق" class="btn btn-light">
                                                        </span>
                                                    </form>
                                                </p>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-danger text-center" role="alert">
                                <h2>لا يوجد طلبيات</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
