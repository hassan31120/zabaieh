@extends('admin.layouts.main')

@section('dash')
    الطلبيات
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                @if ($order)
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                            <div class="col-6">
                                <h5 class="text-white text-capitalize ps-3" style="margin-right: 10px; font-weight: 700;">
                                    تفاصيل الطلب</h5>
                            </div>
                            <div class="col-6" style="position: relative;"><a href="{{ route('admin.orders') }}"
                                    style="position: absolute; left: 2%" class="btn btn-primary"> الطلبيات </a></div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="">
                            <div class="container-fluid">

                                <div class="container">
                                    <!-- Title -->
                                    <div class="d-flex justify-content-between align-items-center py-3">
                                        <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> طلب
                                            {{ $order->user->name }}</h2>
                                    </div>

                                    <!-- Main content -->
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <!-- Details -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="mb-3 d-flex justify-content-between">
                                                        <div>
                                                            <span
                                                                class="me-3">{{ $order->created_at->format('d/m/Y') }}</span>
                                                            <span class="me-3">#{{ $order->id }}</span>
                                                            <span class="me-3">{{ $order->pay_method }}</span>
                                                            <span
                                                                class="badge rounded-pill bg-info">{{ $order->status }}</span>
                                                        </div>
                                                    </div>
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex mb-2">
                                                                        <div class="flex-shrink-0">
                                                                            <img src="{{ asset($order->product->image) }}"
                                                                                alt="" width="100"
                                                                                class="img-thumbnail">
                                                                        </div>
                                                                        <div class="flex-lg-grow-1 ms-3"
                                                                            style="margin-right: 20px;margin-top: 5px;">
                                                                            <h6 class="small mb-0">
                                                                                {{ $order->product->name }}</h6>
                                                                            <span
                                                                                class="small">{{ $order->product->weight }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-end"
                                                                    style="margin-top: 25px;position: absolute;left: 20px;">
                                                                    {{ $order->product->new_price }}</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot style="position: relative;top: 25px;right: 20px;">
                                                            <tr>
                                                                <td colspan="2">سعر الطلب</td>
                                                                <td class="text-end" style="position: absolute;left: 20px;">
                                                                    {{ $order->product->new_price }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">سعر الشحن</td>
                                                                <td class="text-end" style="position: absolute;left: 20px;">
                                                                    {{ $order->address->cities->price }}
                                                                </td>
                                                            </tr>
                                                            <tr class="fw-bold">
                                                                <td colspan="2">الإجمالي</td>
                                                                <td class="text-end" style="position: absolute;left: 20px;">
                                                                    {{ $order->total }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Payment -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h3 class="h6">Payment Method</h3>
                                                            <p>Visa -1234 <br>
                                                                Total: $169,98 <span
                                                                    class="badge bg-success rounded-pill">PAID</span></p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h3 class="h6">Billing address</h3>
                                                            <address>
                                                                <strong>John Doe</strong><br>
                                                                1355 Market St, Suite 900<br>
                                                                San Francisco, CA 94103<br>
                                                                <abbr title="Phone">P:</abbr> (123) 456-7890
                                                            </address>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <!-- Customer Notes -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <h3 class="h6">Customer Notes</h3>
                                                    <p>Sed enim, faucibus litora velit vestibulum habitasse. Cras lobortis
                                                        cum sem aliquet mauris rutrum. Sollicitudin. Morbi, sem tellus
                                                        vestibulum porttitor.</p>
                                                </div>
                                            </div>
                                            <div class="card mb-4">
                                                <!-- Shipping information -->
                                                <div class="card-body">
                                                    <h3 class="h6">Shipping Information</h3>
                                                    <strong>FedEx</strong>
                                                    <span><a href="#" class="text-decoration-underline"
                                                            target="_blank">FF1234567890</a> <i
                                                            class="bi bi-box-arrow-up-right"></i> </span>
                                                    <hr>
                                                    <h3 class="h6">Address</h3>
                                                    <address>
                                                        <strong>John Doe</strong><br>
                                                        1355 Market St, Suite 900<br>
                                                        San Francisco, CA 94103<br>
                                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                                    </address>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    noo
                @endif
            </div>
        </div>
    </div>
@endsection
