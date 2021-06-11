@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
        <span class="text-capitalize">{{__('customer_msg.menu_BuyTuningCredits')}}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li class="active">{{__('customer_msg.menu_BuyTuningCredits')}}</li>
	  </ol>
	</section>
@endsection

@section('content')
@php
	$isPayAble = FALSE;
	$isVatCalculation = FALSE;
	if(($company->vat_number != null) && ($company->vat_percentage != null) && ($user->add_tax)){
		$isVatCalculation = TRUE;
	}
@endphp
<div class="row">
	<div class="col-md-12">
		<form method="POST" action="{{ route('pay.with.paypal') }}">
		  	@csrf
		  	<div class="box">
                @if($tuningCreditGroup || $tuningEVCCreditGroup)
                    @if($tuningCreditGroup)
                    <input type="hidden" name="tuning_credit_group_id" value="{{ $tuningCreditGroup->id }}">
                    @endif
                    @if($tuningEVCCreditGroup)
                    <input type="hidden" name="tuning_evc_credit_group_id" value="{{ $tuningEVCCreditGroup->id }}">
                    @endif
                    <input type="hidden" name="credit_type" value="">
		  			<input type="hidden" name="vat_number" value="{{ $company->vat_number }}">
		  			<input type="hidden" name="vat_percentage" value="{{ ($company->vat_number != null && $user->add_tax)?$company->vat_percentage:'' }}">
		  			<input type="hidden" name="item_name" value="Tuning credit">
		  			<input type="hidden" name="item_description" value="">
		  			<input type="hidden" name="item_amount" value="">
		  			<input type="hidden" name="total_amount" value="">
		  			<input type="hidden" name="item_tax" value="">
		  			<input type="hidden" name="item_tax_percentage" value="{{ ($company->vat_number != null && $user->add_tax)?$company->vat_percentage:'' }}">

                    <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">
                        @if($tuningCreditGroup)
			    		<div class="col-md-6 table-responsive">
                            <h2 style='color: white'>
                                <span class="text-capitalize">Original</span>
                            </h2>
			    			<table class="table table-striped">
			    				<thead>
			    					<tr>
					    				<th>&nbsp;</th>
					    				<th>{{__('customer_msg.tb_header_Description')}}</th>
                                        <th>{{__('customer_msg.tb_header_From')}}</th>
                                        <th>{{__('customer_msg.tb_header_For')}}</th>
					    				<th>&nbsp;</th>
					    			</tr>
			    				</thead>
			    				<tbody>
			    					@if($groupCreditTires->count() > 0)
			    						@foreach($groupCreditTires as $groupCreditTire)
					    					<tr>
								    			<td>
								    				<input type="radio" name="item_credits" value="{{ $groupCreditTire->amount }}" {{ ($loop->first)?'checked="checked"':'' }} data-item-amount="{{ $groupCreditTire->pivot->for_credit }}" data-item-description="purchase {{ $groupCreditTire->amount }} tuning credit">
								    			</td>
								    			<td>{{ $groupCreditTire->amount }} credits</td>
								    			<td>
								    				{{ config('site.currency_sign') }}
								    				{{
						    							number_format($groupCreditTire->pivot->from_credit, 2)
						    						}}
								    			</td>
								    			<td>
								    				{{ config('site.currency_sign') }}
								    				{{
						    							number_format($groupCreditTire->pivot->for_credit, 2)
						    						}}
								    			</td>
								    			<td>
								    				@if($groupCreditTire->pivot->from_credit > $groupCreditTire->pivot->for_credit)
								    					Save {{ config('site.currency_sign').' '.number_format(($groupCreditTire->pivot->from_credit - $groupCreditTire->pivot->for_credit), 2) }}
								    				@endif
								    			</td>
								    		</tr>
								    		@php
								    			$isPayAble = TRUE;
								    		@endphp
							    		@endforeach
						    		@endif

						    		@if($isVatCalculation == TRUE)
							    		<tr>
							    			<td>&nbsp;</td>
							    			<td>&nbsp;</td>
							    			<td>VAT (<span class="vat_percentage">0</span>)%</td>
							    			<td>&nbsp;</td>
							    			<td>
							    				{{ config('site.currency_sign') }}
							    				<span class="vat_amount">0.00</span>
							    			</td>
							    		</tr>
						    		@endif

						    		<tr>
					    				<th>&nbsp;</th>
					    				<th>&nbsp;</th>
					    				<th>{{__('customer_msg.tb_header_OrderTotal')}}</th>
					    				<th>&nbsp;</th>
					    				<th>
					    					{{ config('site.currency_sign') }}
					    					<span class="payable-amount"></span>
					    				</th>
					    			</tr>
			    				</tbody>
                            </table>

				    		<h4>{{__('customer_msg.buytuning_PaymentMethod')}}</h4>
				    		<div class="form-group">
				    			<img src="{{ asset('images/paypal.png') }}">
				            </div>
                        </div>
                        @endif
                        @if($tuningEVCCreditGroup && $company->reseller_id && $user->reseller_id)
                        <div class="col-md-6 table-responsive">
                            <h2>
                                <span class="text-capitalize">EVC credits</span>
                            </h2>
                            <table class="table table-striped">
			    				<thead>
			    					<tr>
					    				<th>&nbsp;</th>
					    				<th>{{__('customer_msg.tb_header_Description')}}</th>
                                        <th>{{__('customer_msg.tb_header_From')}}</th>
                                        <th>{{__('customer_msg.tb_header_For')}}</th>
					    				<th>&nbsp;</th>
					    			</tr>
			    				</thead>
			    				<tbody>
			    					@if($groupEVCCreditTires->count() > 0)
			    						@foreach($groupEVCCreditTires as $groupCreditTire)
					    					<tr>
								    			<td>
								    				<input type="radio" name="item_credits" class='evc_items' value="{{ $groupCreditTire->amount }}" data-item-amount="{{ $groupCreditTire->pivot->for_credit }}" data-item-description="purchase {{ $groupCreditTire->amount }} evc tuning credit">
								    			</td>
								    			<td>{{ $groupCreditTire->amount }} credits</td>
								    			<td>
								    				{{ config('site.currency_sign') }}
								    				{{
						    							number_format($groupCreditTire->pivot->from_credit, 2)
						    						}}
								    			</td>
								    			<td>
								    				{{ config('site.currency_sign') }}
								    				{{
						    							number_format($groupCreditTire->pivot->for_credit, 2)
						    						}}
								    			</td>
								    			<td>
								    				@if($groupCreditTire->pivot->from_credit > $groupCreditTire->pivot->for_credit)
								    					Save {{ config('site.currency_sign').' '.number_format(($groupCreditTire->pivot->from_credit - $groupCreditTire->pivot->for_credit), 2) }}
								    				@endif
								    			</td>
								    		</tr>
								    		@php
								    			$isPayAble = TRUE;
								    		@endphp
							    		@endforeach
						    		@endif

						    		@if($isVatCalculation == TRUE)
							    		<tr>
							    			<td>&nbsp;</td>
							    			<td>&nbsp;</td>
							    			<td>VAT (<span class="vat_percentage">0</span>)%</td>
							    			<td>&nbsp;</td>
							    			<td>
							    				{{ config('site.currency_sign') }}
							    				<span class="vat_amount">0.00</span>
							    			</td>
							    		</tr>
						    		@endif

						    		<tr>
					    				<th>&nbsp;</th>
					    				<th>&nbsp;</th>
					    				<th>{{__('customer_msg.tb_header_OrderTotal')}}</th>
					    				<th>&nbsp;</th>
					    				<th>
					    					{{ config('site.currency_sign') }}
					    					<span class="payable-amount-evc"></span>
					    				</th>
					    			</tr>
			    				</tbody>
				    		</table>
                        </div>
                        @endif
			    	</div><!-- /.box-body -->
				    <div class="box-footer">
		                <div id="saveActions" class="form-group">
						    <div class="btn-group">
						        <button type="submit" class="btn btn-danger" {{ ($isPayAble == FALSE)?'disabled=disabled':'' }}>
						            <span>Buy</span>
						        </button>
						    </div>
						    <a href="{{ url('customer/dashboard') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
						</div>
			    	</div><!-- /.box-footer-->
		    	@else
			  		{{ __('customer.no_credit_group_of_user') }}
			  	@endif
		  	</div><!-- /.box -->
		</form>
	</div>
</div>

@endsection

@push('after_scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			var element, itemDescription, itemAmount, totalAmount, vatPercentage;
			vatPercentage = 0.00;

			@if($isVatCalculation == TRUE)
				vatPercentage = '{{ $company->vat_percentage }}';
			@endif
			vatPercentage = parseFloat(vatPercentage);
            element = $('input[name=item_credits]:checked');
			itemDescription = element.attr('data-item-description');
			itemAmount = element.attr('data-item-amount');
			itemAmount = parseFloat(itemAmount);
			vatAmount = (itemAmount*vatPercentage/100);
			totalAmount = (itemAmount+vatAmount);
	        $('input[name=item_description]').val(itemDescription);
	        $('input[name=item_amount]').val(itemAmount.toFixed(2));
	        $('input[name=item_tax]').val(vatAmount.toFixed(2));
            $('input[name=total_amount]').val(totalAmount.toFixed(2));
            if ($(element).hasClass('evc_items')) {
                $('.payable-amount-evc').text(totalAmount.toFixed(2));
                $('.payable-amount').text('');
                $('input[name=credit_type]').val('evc');
            } else {
                $('.payable-amount-evc').text('');
                $('.payable-amount').text(totalAmount.toFixed(2));
                $('input[name=credit_type]').val('normal');
            }

			@if($isVatCalculation == TRUE)
				$('.vat_percentage').text(vatPercentage);
				$('.vat_amount').text(vatAmount.toFixed(2));
			@endif
			$('input[name=item_credits]').on('click', function(){
				element = $(this);
	            if(element.prop("checked") == true){
	            	itemDescription = element.attr('data-item-description');
	            	itemAmount = element.attr('data-item-amount');
	            	itemAmount = parseFloat(itemAmount);
	            	vatAmount = (itemAmount*vatPercentage/100);
	            	totalAmount = (itemAmount+vatAmount);
			        $('input[name=item_description]').val(itemDescription);
			        $('input[name=item_amount]').val(itemAmount.toFixed(2));
			        $('input[name=item_tax]').val(vatAmount.toFixed(2));
                    $('input[name=total_amount]').val(totalAmount.toFixed(2));
                    if ($(element).hasClass('evc_items')) {
                        $('.payable-amount-evc').text(totalAmount.toFixed(2));
                        $('.payable-amount').text('');
                        $('input[name=credit_type]').val('evc');
                    } else {
                        $('.payable-amount-evc').text('');
                        $('.payable-amount').text(totalAmount.toFixed(2));
                        $('input[name=credit_type]').val('normal');
                    }
					@if($isVatCalculation == TRUE)
						$('.vat_percentage').text(vatPercentage);
						$('.vat_amount').text(vatAmount.toFixed(2));
					@endif
	            }
			});
		});
	</script>
@endpush
