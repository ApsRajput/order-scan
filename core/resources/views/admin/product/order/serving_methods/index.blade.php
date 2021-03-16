
@extends('admin.layout')

@section('styles')
<style>
    .tooltip-inner {
        max-width: 500px;
    }
</style>
@endsection

@section('content')
  <div class="page-header">
    <h4 class="page-title">
      Serving Methods
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">Order Management</a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          Serving Methods
        </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <h3>Serving Methods</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
                <div id="refreshOrder">
                    <div class="table-responsive">
                      <table class="table table-striped mt-3">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Offline Gateways</th>
                            {{-- <th scope="col">QR Scan Payment</th> --}}
                            <th scope="col">Action</th>
                          </tr>
                        </thead>

                        <tbody>
                            @foreach ($servingMethods as $sm)
                                <tr>
                                    <td>{{$sm->name}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#statusModal{{$sm->id}}">Manage</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#gatewaysModal{{$sm->id}}">Manage</button>
                                    </td>
                                    {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{route('admin.product.qrPayment')}}" method="POST" id="qrPayment{{$sm->id}}">
                                                @csrf
                                                <input type="hidden" name="serving_method" value="{{$sm->id}}">
                                                <select name="qr_payment" class="{{$sm->qr_payment == 1 ? 'bg-success' : 'bg-danger'}} form-control-sm text-white border-0" onchange="document.getElementById('qrPayment{{$sm->id}}').submit();">
                                                    <option value="1" {{$sm->qr_payment == 1 ? 'selected' : ''}}>Active</option>
                                                    <option value="0" {{$sm->qr_payment == 0 ? 'selected' : ''}}>Deactive</option>
                                                </select>
                                            </form>
                                            <i class="fas fa-info-circle ml-2 qr-payment-info" style="cursor: pointer;font-size: 18px;" data-toggle="tooltip" data-placement="bottom" title="'QR Scan Payment' is only applicable for online payment gateways (ex- paypal, stripe etc..). If it is enable, then payment won't be completed online after order. it will be paid only after customer scans the QR code."></i>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{$sm->id}}">Edit</a>
                                    </td>
                                </tr>
                                @includeIf('admin.product.order.serving_methods.partials.status')
                                @includeIf('admin.product.order.serving_methods.partials.gateways')
                                @includeIf('admin.product.order.serving_methods.partials.edit')
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
