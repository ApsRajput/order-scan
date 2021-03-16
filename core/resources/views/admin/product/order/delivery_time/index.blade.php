
@extends('admin.layout')

@section('content')
  <div class="page-header">
    <h4 class="page-title">
        Delivery Time Frame Management
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
            Delivery Time Frame Management
        </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <h3>Delivery Time Frame Management</h3>
        </div>
        <div class="card-body">
            <div class="alert alert-warning text-center py-4">
                <h4 class="text-warning mb-0"><strong>These delivery time frames will be shown to customers in checkout page. Customer can choose the delivery Time Frames</strong></h4>
            </div>
            <form action="{{route('admin.deliveryStatus')}}" id="statusForm" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="delivery_date_time_status" class="form-control {{$be->delivery_date_time_status == 1 ? 'bg-success' : 'bg-danger'}}" onchange="document.getElementById('statusForm').submit()">
                                        <option value="1" {{$be->delivery_date_time_status == 1 ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{$be->delivery_date_time_status == 0 ? 'selected' : ''}}>Deactive</option>
                                    </select>
                                    <p class="text-warning mb-0">This will decide whether delivery date / time fields will be shown in checkout page</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Required</label>
                                    <select name="delivery_date_time_required" class="form-control {{$be->delivery_date_time_required == 1 ? 'bg-success' : 'bg-danger'}}" onchange="document.getElementById('statusForm').submit()">
                                        <option value="1" {{$be->delivery_date_time_required == 1 ? 'selected' : ''}}>Yes</option>
                                        <option value="0" {{$be->delivery_date_time_required == 0 ? 'selected' : ''}}>No</option>
                                    </select>
                                    <p class="text-warning mb-0">This will decide whether delivery date / time fields are required or optional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Day</th>
                        <th scope="col">Time Frames</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Monday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="monday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'monday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Tuesday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="tuesday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'tuesday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="wednesday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'wednesday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Thursday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="thursday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'thursday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="friday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'friday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Saturday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="saturday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'saturday'])}}">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Sunday</td>
                            <td>
                                <button class="btn btn-primary addTF" data-day="sunday">Add</button>
                                <a class="btn btn-info" href="{{route('admin.timeframes', ['day' => 'sunday'])}}">View</a>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  @includeIf('admin.product.order.delivery_time.create')
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $(".addTF").on('click', function(e) {
            e.preventDefault();
            $("#createModal").modal('show');
            $("input[name='day']").val($(this).data('day'));
        })
    });
</script>
@endsection
