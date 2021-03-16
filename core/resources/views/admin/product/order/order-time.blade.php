@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">Order Times</h4>
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
        <a href="#">Order Times</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form class="" action="{{route('admin.ordertime.update')}}" method="post">
          @csrf
          <div class="card-header">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card-title">Update Order Times</div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-8 offset-lg-2">
                <h4 class="text-warning text-center">Orders will be received between these times.</h4>
                @csrf
                @foreach ($ordertimes as $ot)
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <button style="cursor: auto;" class="btn btn-block btn-primary text-capitalize" type="button">{{$ot->day}}</button>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group p-0">
                            <input class="form-control ordertimepicker" name="start_time[]" value="{{$ot->start_time}}" autocomplete="off" placeholder="Start Time">
                            </div>
                        </div>
                        <div class="col-lg-4 p-0">
                            <div class="form-group">
                            <input class="form-control ordertimepicker" name="end_time[]" value="{{$ot->end_time}}" placeholder="End Time" autocomplete="off">
                            </div>
                        </div>
                    </div>
                @endforeach
                <p class="mb-0 text-warning text-center" style="font-size: 16px;">If you do not take orders at a specific day, leave input fields blank for that day. </p>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.ordertimepicker').mdtimepicker();

        });
    </script>
@endsection
