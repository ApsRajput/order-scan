<div class="modal fade" id="variationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <span></span>
                    <small class="ml-2">
                        ({{$be->base_currency_text_position == 'left' ? $be->base_currency_text : ''}}
                        <span id="productPrice"></span>
                        {{$be->base_currency_text_position == 'right' ? $be->base_currency_text : ''}})
                    </small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="variation-label">
                    <strong>{{__('Select Variation')}} **</strong>
                </div>
                <div id="variants">
                    {{-- All variants will be appended here by jquery --}}
                </div>

                <div class="addon-label mt-3">
                    <strong>{{__("Select Add On's")}} ({{__("Optional")}})</strong>
                </div>
                <div id="addons">
                    {{-- All addons will be appended here by jquery --}}
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-3">
                    <div class="modal-quantity">
                        <span class="minus"><i class="fas fa-minus"></i></span>
                        <input class="form-control" type="number" name="cart-amount" value="1" min="1">
                        <span class="plus"><i class="fas fa-plus"></i></span>
                    </div>
                </div>
                <div class="col-lg-9">
                    <button type="button" class="btn btn-primary btn-block text-uppercase modal-cart-link">
                        <span class="d-block">{{__('Add to Cart')}}</span>
                        <i class="fas fa-spinner d-none"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
