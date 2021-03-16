@extends('front.qrmenu.layout')

@section('page-heading')
    {{__('Success')}}
@endsection

@section('content')<!-- content  -->
<div class="content">
    <!--  section  -->
    <section class="hidden-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 p-4 bg-light">
                    <div class="checkout-success">
                        <div class="icon text-success"><i class="far fa-check-circle"></i></div>
                        <h2>{{__('Success')}}!</h2>
                        <p class="mb-0">{{__('Your order number is: ')}}<strong class="text-danger">#{{$orderNum ?? ''}}</strong></p>
                        <p class="mb-0"><strong>{{__('Please take a note of the order number')}}</strong></p>
                        <p class="mb-0">{{__('We have sent you a mail with an invoice.')}}</p>
                        <p class="mt-3">{{__('Thank you.')}}</p>
                        <a class="main-btn main-btn-2" href="{{route('front.qrmenu')}}">{{__('Return to Menu')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  section end  -->
</div>
<!-- content end  -->


@endsection

