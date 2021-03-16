@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">QR Builder</h4>
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
        <a href="#">QR Builder</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form id="ajaxForm" action="{{route('admin.qrcode.generate')}}" method="post">
            @csrf
          <div class="card-header">
            <div class="card-title">Build QR Code for Your Menu</div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                @csrf
                <div class="form-group">
                  <label for="">URL **</label>
                  <input type="text" class="form-control" name="url" value="{{$abe->qrcode_url}}" placeholder="Enter URL to redirect after scan">
                  <p class="text-warning">Add '/qr-menu' after the main URL</p>
                  @if ($errors->has('url'))
                    <p class="mb-0 text-danger">{{$errors->first('url')}}</p>
                  @endif
                </div>

                <div class="form-group">
                  <label for="">Color **</label>
                  <input type="text" class="form-control jscolor" name="color" value="{{$abe->qrcode_color}}" placeholder="Enter color">
                  @if ($errors->has('color'))
                    <p class="mb-0 text-danger">{{$errors->first('color')}}</p>
                  @endif
                </div>

                <div class="form-group">
                    <label for="">Generated QR Code</label><br>
                    <div class="bg-white p-5 d-inline-block">
                        <img src="{{asset('assets/front/img/qrcode.png') . '?' . time()}}" alt="">
                    </div><br>
                    <a href="{{asset('assets/front/img/qrcode.png')}}" class="btn btn-primary btn-sm mt-2" download="qrcode.png">Download Image</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer pt-3">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-lg-3 col-md-3 col-sm-12">

                </div>
                <div class="col-12 text-center">
                  <button type="submit" id="submitBtn" class="btn btn-success">Generate QR Code</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

@endsection

