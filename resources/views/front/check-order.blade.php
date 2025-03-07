@extends('front/layouts/masterlayout')
@section('content')
@section('title', 'Kiểm tra đơn hàng')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid ">
    <div class="row px-xl-12">
        <div class="col-lg-12 col-12 text-left">
            <form action="{{ route('check.order') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="q" class="form-control"
                        placeholder="Nhập số điện thoại hoặc email đặt hàng" value="{{ request('q') }}">
                    <div class="input-group-append">
                        <span class="">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>


       @if (request('q') != '')
       <div class="col-lg-12 table-responsive mb-5 mt-5">
           <table class="table table-bordered text-center mb-0">
               <thead class="bg-secondary text-dark">
                   <tr>
                       <th>Thông tin</th>
                       <th>Địa chỉ</th>
                       <th>Tổng tiền</th>
                       <th>Trạng thái</th>
                       <th><i class="fa fa-info-circle" aria-hidden="true"></th>
                   </tr>
               </thead>
               <tbody class="align-middle">
                   @foreach ($order as $i => $item)
                       <tr>
                           <td class="text-left">
                               <div class="col-12">Tên KH: {{ $item->name }}</div>
                               <div class="col-12">Email: {{ $item->email }}</div>
                               <div class="col-12">SĐT: {{ $item->phone }}</div>
                               <div class="col-12">Thời gian: {{ $item->created_at->format('d/m/Y') }}</div>

                           </td>
                           <td class="align-middle">{{ $item->street_address }}, {{ $item->ward }},
                               {{ $item->district }},
                               {{ $item->provincial }}</td>
                           <td class="align-middle">
                               @php
                                   $main_total = 0;
                                   foreach ($item->orderDetails as $key => $value) {
                                       $main_total += $value->total;
                                   }
                               @endphp
                               {{ number_format($main_total, 0, '.', '.') }} VND
                           </td>
                           <td class="align-middle">
                               @switch($item->status)
                                   @case('new')
                                       <div>Đơn hàng mới</div>
                                   @break

                                   @case('preparing goods')
                                       <div>Chuẩn bị hàng</div>
                                   @break

                                   @case('delivering')
                                       <div>Đang giao</div>
                                   @break

                                   @case('delivered')
                                       <div>Đã giao</div>
                                   @break

                                   @case('order has been cancelled')
                                       <div>Đã bị hủy</div>
                                   @break

                                   @default
                               @endswitch
                           </td>
                           <td class="align-middle">
                               <a href="{{route('order.detail.user',['id' => $item->id])}}"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                           </td>
                       </tr>
                   @endforeach
               </tbody>
           </table>
           <div class="col-12 pb-1">
               {{ $order->appends(request()->all())->links('front/layouts/my-pagination') }}
           </div>
       </div>
           
       @endif 

    </div>
</div>

</div>
@endsection
