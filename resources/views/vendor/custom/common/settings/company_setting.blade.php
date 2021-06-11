@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<h1>
	        <span class="text-capitalize">Company information</span>
		</h1>
	  <ol class="breadcrumb">
	    <li>
	    	<a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a>
	    </li>
	    <li class="active"> Company information</li>
	  </ol>
	</section>
@endsection
@php
// $old = session()->getOldInput();
// dd(old('main_email_address') ? old('main_email_address') : $company->main_email_address);
// dd((old('main_email_address'))?old('main_email_address'):((@$company->main_email_address)?$company->main_email_address:''));
@endphp
@section('content')
	<form method="POST" action="{{ backpack_url('update-company-setting') }}" enctype="multipart/form-data">
	  	@csrf
	  	<input type="hidden" name="tab_name" value="name_and_address">
	  	<div class="hidden ">
		  	<input name="id" value="{{ @$company->id }}" class="form-control" type="hidden">
		</div>
	  	<div class="row">
			<div class="col-md-12">
				@if($errors->any())
				    <div class="callout callout-danger">
				        <h4>Please fix the errors</h4>
				        <ul>
				            @foreach($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			  	<div class="box">
			  		<div class="box-body display-flex-wrap" style="display: flex; flex-wrap: wrap;">
			  			<div class="nav-tabs-custom">
				            <ul class="nav nav-tabs" id="settingTabs">
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'name_and_address')
				              				active
				              			@endif
				              		@else
				              			active
				              		@endif
				              	">
					              	<a href="#name_and_address" data-tab-name="name_and_address" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_NameAddr')}}
						            </a>
				              	</li>
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'email_addresses')
				              				active
				              			@endif
				              		@endif
				              	">
					              	<a href="#email_addresses" data-tab-name="email_addresses" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_EmailAddr')}}
						            </a>
				              	</li>
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'financial_information')
				              				active
				              			@endif
				              		@endif
				              	">
					              	<a href="#financial_information" data-tab-name="financial_information" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_Financial')}}
						            </a>
				              	</li>
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'notes_to_customers')
				              				active
				              			@endif
				              		@endif
				              	">
					              	<a href="#notes_to_customers" data-tab-name="notes_to_customers" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_NotesCustomers')}}
						            </a>
				              	</li>
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'smtp_setting')
				              				active
				              			@endif
				              		@endif
				              	">
					              	<a href="#smtp_setting" data-tab-name="smtp_setting" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_SMTPinfo')}}
						            </a>
				              	</li>
				              	<li class="
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'paypal_setting')
				              				active
				              			@endif
				              		@endif
				              	">
					              	<a href="#paypal_setting" data-tab-name="paypal_setting" data-toggle="tab" aria-expanded="true">
                                        {{__('customer_msg.company_Paypalinfo')}}
						            </a>
                                  </li>
                                <li class="
                                    @if(session('tabName'))
                                        @if(session('tabName') == 'evc_credits')
                                            active
                                        @endif
                                    @endif
                                    ">
                                    <a href="#evc_credits" data-tab-name="evc_credits" data-toggle="tab" aria-expanded="true">
                                    {{__('customer_msg.company_EvcCredits')}}
                                    </a>
                                </li>
				            </ul>
				            <div class="tab-content">
					            <div class="tab-pane
					            	@if(session('tabName'))
				              			@if(session('tabName') == 'name_and_address')
				              				active
				              			@endif
				              		@else
				              			active
				              		@endif
					            " id="name_and_address">
					            	<div class="row">
					            		<div class="col-md-6 col-xs-12">
					            			<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
										    <label>{{__('customer_msg.tb_header_Name')}}</label>
									        <input name="name" value="{{ (old('name')) ? old('name') : $company->name }}" placeholder="Name" class="form-control" type="text">
									        @if ($errors->has('name'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('name') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('address_line_1') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.contactInfo_AddressLine1')}}</label>
									        <input name="address_line_1" value="{{ (old('address_line_1')) ? old('address_line_1') : $company->address_line_1 }}" placeholder="Address line 1" class="form-control" type="text">
									        @if ($errors->has('address_line_1'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('address_line_1') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('address_line_2') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.contactInfo_AddressLine2')}}<small class="text-muted">({{__('customer_msg.service_Optional')}})</small></label>
									        <input name="address_line_2" value="{{ (old('address_line_2')) ? old('address_line_2') : $company->address_line_2 }}" placeholder="Address line 2" class="form-control" type="text">
									        @if ($errors->has('address_line_2'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('address_line_2') }}</strong>
					                            </span>
					                        @endif
									    </div>

									    <div class="form-group {{ $errors->has('town') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.contactInfo_Town')}}</label>
									        <input name="town" value="{{ (old('town')) ? old('town') : $company->town }}" placeholder="Town" class="form-control" type="text">
									        @if ($errors->has('town'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('town') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group  {{ $errors->has('post_code') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.contactInfo_PostCode')}} <small class="text-muted">({{__('customer_msg.service_Optional')}})</small></label>
									        <input name="post_code" value="{{ (old('post_code')) ? old('post_code') : $company->post_code }}" placeholder="Post Code" class="form-control" type="text">
									        @if ($errors->has('post_code'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('post_code') }}</strong>
					                            </span>
					                        @endif
									    </div>

									    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.contactInfo_County')}}</label>
									        <input name="country" value="{{ (old('country')) ? old('country') : $company->country }}" placeholder="Country" class="form-control" type="text">
									        @if ($errors->has('country'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('country') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_StateProvince')}} <small class="text-muted">({{__('customer_msg.service_Optional')}})</small></label>
									        <input name="state" value="{{ (old('state')) ? old('state') : $company->state }}" placeholder="State/Province" class="form-control" type="text">
									        @if ($errors->has('state'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('state') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_Logo')}}</label>
									        <input name="file" type="file">
									        @if ($errors->has('file'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('file') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('theme_color') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_ThemeColor')}}</label>
									        <input name="theme_color" type="color" value="{{ (old('theme_color')) ? old('theme_color') : ($company->theme_color ? $company->theme_color : '#fff') }}" class="form-control">
									        @if ($errors->has('theme_color'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('theme_color') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('copy_right_text') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_Copyright')}}</small></label>
									        <input name="copy_right_text" value="{{ (old('copy_right_text')) ? old('copy_right_text') : $company->copy_right_text }}" placeholder="Copy right text" class="form-control" type="text">
									        @if ($errors->has('copy_right_text'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('copy_right_text') }}</strong>
					                            </span>
					                        @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('link_name') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_CustomLinkName')}}</small></label>
									        <input name="link_name" value="{{ (old('link_name')) ? old('link_name') : $company->link_name }}" placeholder="Custom Link Name" class="form-control" type="text">
									        @if ($errors->has('link_name'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('link_name') }}</strong>
					                            </span>
					                        @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('link_value') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_CustomLink')}}</small></label>
									        <input name="link_value" value="{{ (old('link_value')) ? old('link_value') : $company->link_value }}" placeholder="Custom Link URL" class="form-control" type="text">
									        @if ($errors->has('link_value'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('link_value') }}</strong>
					                            </span>
					                        @endif
									    </div>
					            		</div>
					            	</div>

					            </div>
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'email_addresses')
				              				active
				              			@endif
				              		@endif
				              	" id="email_addresses">
				              		<div class="row">
					            		<div class="col-md-6 col-xs-12">
					            			<div class="form-group {{ $errors->has('main_email_address') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MainEmail')}}</label>
									        <input name="main_email_address" value="{{ (old('main_email_address')) ? old('main_email_address') : $company->main_email_address }}" placeholder="Main email address" class="form-control" type="text">
									        @if ($errors->has('main_email_address'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('main_email_address') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('support_email_address') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_SupportEmail')}}</label>
									        <input name="support_email_address" value="{{ (old('support_email_address')) ? old('support_email_address') : $company->support_email_address }}" placeholder="Support email address" class="form-control" type="text">
									        @if ($errors->has('support_email_address'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('support_email_address') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('billing_email_address') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_BillingEmail')}}</label>
									        <input name="billing_email_address" value="{{ (old('billing_email_address')) ? old('billing_email_address') : $company->billing_email_address }}" placeholder="Billing email address" class="form-control" type="text">
									        @if ($errors->has('billing_email_address'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('billing_email_address') }}</strong>
					                            </span>
					                        @endif
									    </div>
					            		</div>
					            	</div>

				              	</div>
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'financial_information')
				              				active
				              			@endif
				              		@endif
				              	" id="financial_information">
				              		<div class="row">
					            		<div class="col-md-6 col-xs-12">
					            			<div class="form-group {{ $errors->has('bank_account') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_BankAccount')}} <small class="text-muted">(optional)</small></label>
									        <input name="bank_account" value="{{ (old('bank_account')) ? old('bank_account') : $company->bank_account }}" placeholder="Bank account " class="form-control" type="text">
									        @if ($errors->has('bank_account'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('bank_account') }}</strong>
					                            </span>
					                        @endif
									    </div>

									    <div class="form-group {{ $errors->has('bank_identification_code') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_BankCode')}} <small class="text-muted">({{__('customer_msg.service_Optional')}})</small></label>
									        <input name="bank_identification_code" value="{{ (old('bank_identification_code')) ? old('bank_identification_code') : $company->bank_identification_code }}" placeholder="Bank identification code (BIC)" class="form-control" type="text">
									        @if ($errors->has('bank_identification_code'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('bank_identification_code') }}</strong>
					                            </span>
					                        @endif
									    </div>

									    <div class="form-group {{ $errors->has('vat_number') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_VatNum')}}</label>
									        <input name="vat_number" value="{{ (old('vat_number')) ? old('vat_number') : $company->vat_number }}" placeholder="VAT" class="form-control" type="text">
									        @if ($errors->has('vat_number'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('vat_number') }}</strong>
					                            </span>
					                        @endif
									    </div>

									    <div class="form-group {{ $errors->has('vat_percentage') ? ' has-error' : '' }}">
										    <label>VAT%</label>
									        <input name="vat_percentage" value="{{ (old('vat_percentage')) ? old('vat_percentage') : $company->vat_percentage }}" placeholder="VAT%" class="form-control" type="text" {{ (old('vat_number') != null)?'':(@$company->vat_number != null)?'':'disabled:disabled' }}>
									        @if ($errors->has('vat_percentage'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('vat_percentage') }}</strong>
					                            </span>
					                        @endif
									    </div>
					            		</div>
					            	</div>

				              	</div>
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'notes_to_customers')
				              				active
				              			@endif
				              		@endif
				              	" id="notes_to_customers">
				              		<div class="row">
					            		<div class="col-md-6 col-xs-12">
					            			<div class="form-group {{ $errors->has('customer_note') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_NoteCustomer')}} <small class="text-muted">({{__('customer_msg.service_Optional')}})</small></label>
									        <textarea name="customer_note" placeholder="Notes to customer" class="form-control">{{ (old('customer_note')) ? old('customer_note') : $company->customer_note }}</textarea>
									        @if ($errors->has('customer_note'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('customer_note') }}</strong>
					                            </span>
					                        @endif
									    </div>
					            		</div>
					            	</div>

				              	</div>
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'smtp_setting')
				              				active
				              			@endif
				              		@endif
				              	" id="smtp_setting">
				              		<div class="row">
					            		<div class="col-md-6 col-xs-12">
					            			<div class="form-group {{ $errors->has('mail_driver') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailDriver')}}</label>
										    <input type="text" name="mail_driver" readonly="readonly" value="smtp" class="form-control">
									        @if ($errors->has('mail_driver'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_driver') }}</strong>
					                            </span>
					                        @endif
									    </div>
					              		<div class="form-group {{ $errors->has('mail_host') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailHost')}}</label>
									        <input name="mail_host" value="{{ (old('mail_host')) ? old('mail_host') : $company->mail_host }}" placeholder="Mail host" class="form-control" type="text">
									        @if ($errors->has('mail_host'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_host') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('mail_port') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailPort')}}</label>
									        <input name="mail_port" value="{{ (old('mail_port')) ? old('mail_port') : $company->mail_port }}" placeholder="Mail port" class="form-control" type="text">
									        @if ($errors->has('mail_port'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_port') }}</strong>
					                            </span>
					                        @endif
									    </div>
										<div class="form-group {{ $errors->has('mail_encryption') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailEncryption')}}</label>
									        <select name="mail_encryption" class="form-control">
													<option value="">
										        	None
										        </option>
									        	<option value="ssl" {{
									        		(old('mail_encryption') == "ssl") ? "selected='selected'" : ((@$company->mail_encryption == 'ssl') ? "selected='selected'" : '') }}
													>
										        	SSL
										        </option>
									        	<option value="tls"{{
									        		(old('mail_encryption') == "tls") ? "selected='selected'" : ((@$company->mail_encryption == 'tls') ? "selected='selected'" : '') }}
													>
										        	TLS
										        </option>
									        </select>
									        @if ($errors->has('mail_encryption'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_encryption') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('mail_username') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailUsername')}}</label>
									        <input name="mail_username" value="{{ (old('mail_username')) ? old('mail_username') : ((@$company->mail_username)?$company->mail_username:'') }}" placeholder="Mail username" class="form-control" type="text">
									        @if ($errors->has('mail_username'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_username') }}</strong>
					                            </span>
					                        @endif
									    </div>
									    <div class="form-group {{ $errors->has('mail_password') ? ' has-error' : '' }}">
										    <label>{{__('customer_msg.company_MailUserPassword')}}</label>
									        <input type="password" name="mail_password" value="{{ (old('mail_password')) ? old('mail_password') : ((@$company->mail_password)?$company->mail_password:'') }}" placeholder="Mail password" class="form-control" type="text">
									        @if ($errors->has('mail_password'))
					                            <span class="help-block">
					                                <strong>{{ $errors->first('mail_password') }}</strong>
					                            </span>
					                        @endif
									    </div>
					            		</div>
					            	</div>

				              	</div>
				              	<!-- /.tab-pane -->
				              	<div class="tab-pane
				              		@if(session('tabName'))
				              			@if(session('tabName') == 'paypal_setting')
				              				active
				              			@endif
				              		@endif
				              	" id="paypal_setting">
									<p>
										<strong>Note: </strong>{{__('customer_msg.company_NoteDesc')}}: <a href="https://developer.paypal.com/developer/applications">https://developer.paypal.com/developer/applications</a>. Click on : MY APPS AND CREDENTIALS, Scroll down to REST API apps and click CREATE APP.
					            			</p>
				              		<div class="row">
					            		<div class="col-md-6 col-xs-12">
						              		<div class="form-group {{ $errors->has('paypal_client_id') ? ' has-error' : '' }}">
											    <label>{{__('customer_msg.company_PaypalId')}}</label>
										        <input name="paypal_client_id" value="{{ (old('paypal_client_id'))?old('paypal_client_id'):((@$company->paypal_client_id)?$company->paypal_client_id:'') }}" placeholder="Paypal client id" class="form-control" type="text">
										        @if ($errors->has('paypal_client_id'))
						                            <span class="help-block">
						                                <strong>{{ $errors->first('paypal_client_id') }}</strong>
						                            </span>
						                        @endif
										    </div>
										    <div class="form-group {{ $errors->has('paypal_secret') ? ' has-error' : '' }}">
											    <label>{{__('customer_msg.company_PaypalSecret')}}</label>
										        <input name="paypal_secret" value="{{ (old('paypal_secret'))?old('paypal_secret'):((@$company->paypal_secret)?$company->paypal_secret:'') }}" placeholder="Paypal secret" class="form-control" type="text">
										        @if ($errors->has('paypal_secret'))
						                            <span class="help-block">
						                                <strong>{{ $errors->first('paypal_secret') }}</strong>
						                            </span>
						                        @endif
										    </div>

										    <div class="form-group {{ $errors->has('paypal_currency_code') ? ' has-error' : '' }}">
											    <label>{{__('customer_msg.company_PaypalCurrencyCode')}}</label>
										        @if (Auth::id() == 11)
										        <input name="paypal_currency_code" value="{{ (old('paypal_currency_code'))?old('paypal_currency_code'):((@$company->paypal_currency_code)?$company->paypal_currency_code:'') }}" placeholder="Paypal currency code" class="form-control" type="text">
												@else
												<select name="paypal_currency_code" class="form-control">

													<option value="null" {{
														(old('paypal_currency_code') == "null") ? "selected='selected'" : ((@$company->paypal_currency_code == 'null') ? "selected='selected'" : '') }}
														>
														Select Currency
													</option>
													<option value="AUD" {{
														(old('paypal_currency_code') == "AUD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'AUD') ? "selected='selected'" : '') }}
														>
														AUD
													</option>
													<option value="BRL" {{
														(old('paypal_currency_code') == "BRL") ? "selected='selected'" : ((@$company->paypal_currency_code == 'BRL') ? "selected='selected'" : '') }}
														>
														BRL
													</option>
													<option value="CAD" {{
														(old('paypal_currency_code') == "CAD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'CAD') ? "selected='selected'" : '') }}
														>
														CAD
													</option>
													<option value="CZK" {{
														(old('paypal_currency_code') == "CZK") ? "selected='selected'" : ((@$company->paypal_currency_code == 'CZK') ? "selected='selected'" : '') }}
														>
														CZK
													</option>
													<option value="DKK" {{
														(old('paypal_currency_code') == "DKK") ? "selected='selected'" : ((@$company->paypal_currency_code == 'DKK') ? "selected='selected'" : '') }}
														>
														DKK
													</option>
													<option value="HKD" {{
														(old('paypal_currency_code') == "HKD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'HKD') ? "selected='selected'" : '') }}
														>
														HKD
													</option>
													<option value="ILS" {{
														(old('paypal_currency_code') == "ILS") ? "selected='selected'" : ((@$company->paypal_currency_code == 'ILS') ? "selected='selected'" : '') }}
														>
														ILS
													</option>
													<option value="MXN" {{
														(old('paypal_currency_code') == "MXN") ? "selected='selected'" : ((@$company->paypal_currency_code == 'MXN') ? "selected='selected'" : '') }}
														>
														MXN
													</option>
													<option value="NOK" {{
														(old('paypal_currency_code') == "NOK") ? "selected='selected'" : ((@$company->paypal_currency_code == 'NOK') ? "selected='selected'" : '') }}
														>
														NOK
													</option>
													<option value="EUR" {{
														(old('paypal_currency_code') == "EUR") ? "selected='selected'" : ((@$company->paypal_currency_code == 'EUR') ? "selected='selected'" : '') }}
														>
														EUR
													</option>
													<option value="NZD" {{
														(old('paypal_currency_code') == "NZD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'NZD') ? "selected='selected'" : '') }}
														>
														NZD
													</option>
													<option value="INR" {{
														(old('paypal_currency_code') == "INR") ? "selected='selected'" : ((@$company->paypal_currency_code == 'INR') ? "selected='selected'" : '') }}
														>
														INR
													</option>
													<option value="PHP" {{
														(old('paypal_currency_code') == "PHP") ? "selected='selected'" : ((@$company->paypal_currency_code == 'PHP') ? "selected='selected'" : '') }}
														>
														PHP
													</option>
													<option value="PLN" {{
														(old('paypal_currency_code') == "PLN") ? "selected='selected'" : ((@$company->paypal_currency_code == 'PLN') ? "selected='selected'" : '') }}
														>
														PLN
													</option>
													<option value="GBP" {{
														(old('paypal_currency_code') == "GBP") ? "selected='selected'" : ((@$company->paypal_currency_code == 'GBP') ? "selected='selected'" : '') }}
														>
														GBP
													</option>
													<option value="SGD" {{
														(old('paypal_currency_code') == "SGD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'SGD') ? "selected='selected'" : '') }}
														>
														SGD
													</option>
													<option value="SEK" {{
														(old('paypal_currency_code') == "SEK") ? "selected='selected'" : ((@$company->paypal_currency_code == 'SEK') ? "selected='selected'" : '') }}
														>
														SEK
													</option>
													<option value="CHF" {{
														(old('paypal_currency_code') == "CHF") ? "selected='selected'" : ((@$company->paypal_currency_code == 'CHF') ? "selected='selected'" : '') }}
														>
														CHF
													</option>
													<option value="THB" {{
														(old('paypal_currency_code') == "THB") ? "selected='selected'" : ((@$company->paypal_currency_code == 'THB') ? "selected='selected'" : '') }}
														>
														THB
													</option>
													<option value="USD" {{
														(old('paypal_currency_code') == "USD") ? "selected='selected'" : ((@$company->paypal_currency_code == 'USD') ? "selected='selected'" : '') }}
														>
														USD
													</option>
												</select>
												@endif
										        @if ($errors->has('paypal_currency_code'))
						                            <span class="help-block">
						                                <strong>{{ $errors->first('paypal_currency_code') }}</strong>
						                            </span>
						                        @endif
										    </div>
					            		</div>
					            	</div>
				              	</div>
                                <div class="tab-pane
                                  @if(session('tabName'))
                                      @if(session('tabName') == 'evc_credits')
                                          active
                                      @endif
                                  @endif
                                  " id="evc_credits">
                                  <p>
                                  To Activate the reseller function enter reseller credentials.
                                  </p>
                                  <div class="row">
                                      <div class="col-md-6 col-xs-12">
                                          <div class="form-group {{ $errors->has('reseller_id') ? ' has-error' : '' }}">
                                              <label>{{__('customer_msg.company_ResellerId')}}</label>
                                              <input name="reseller_id" value="{{ (old('reseller_id'))?old('reseller_id'):((@$company->reseller_id)?$company->reseller_id:'') }}" placeholder="Reseller Id" class="form-control" type="text">
                                              @if ($errors->has('reseller_id'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('reseller_id') }}</strong>
                                                  </span>
                                              @endif
                                          </div>
                                          <div class="form-group {{ $errors->has('reseller_password') ? ' has-error' : '' }}">
                                              <label>{{__('customer_msg.company_ResellerPassword')}}</label>
                                              <input name="reseller_password" value="{{ (old('reseller_password'))?old('reseller_password'):((@$company->reseller_password)?$company->reseller_password:'') }}" placeholder="Reseller Password" class="form-control" type="text">
                                              @if ($errors->has('reseller_password'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('reseller_password') }}</strong>
                                                  </span>
                                              @endif
                                          </div>
                                      </div>
                                  </div>
                              </div>
                                  <!-- /.tab-pane -->
				            </div>
				            <!-- /.tab-content -->
				        </div>

			  		</div>
			  		<div class="box-footer">
		                <div id="saveActions" class="form-group">
						    <div class="btn-group">
						        <button type="submit" class="btn btn-danger">
						            <span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
						            <span>Save</span>
						        </button>
						    </div>
						    <a href="{{ backpack_url('tuning-credit') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
						</div>
			    	</div><!-- /.box-footer-->
			  	</div>

			</div>
		</div>
	</form>

@endsection
@push('after_styles')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bower_components/bootstrap-fileinput-master/css/fileinput.min.css') }}">
@endpush

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('after_scripts')
    <script src="{{ asset('vendor/adminlte/bower_components/bootstrap-fileinput-master/js/fileinput.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("input[type=file]").fileinput({
                showUpload: false,
                showRemove: false,
                layoutTemplates: {footer: ''},
                overwriteInitial: true,
                @if($company->logo != null)
			        initialPreview: [
			            '{{ asset("uploads/logo/" . $company->logo) }}',
			        ],
			        initialPreviewAsData: true,
			        initialPreviewConfig: [
			        	{caption: "", url: "", key: "{{ $company->id }}"},
			        ],
		        @endif
            });


            $('#settingTabs li a').on('click', function(){
            	var element = $(this);
            	$('input[name=tab_name]').val(element.attr('data-tab-name'));
            });

            $("input[name=vat_number]").on('keyup', function(){
            	var element = $(this);
            	var vat = element.val();
            	if(vat.length > 0){
            		$('input[name=vat_percentage]').removeAttr('disabled');
            	}else{
            		$('input[name=vat_percentage]').attr('disabled', 'disabled');
            	}
            });
        });
    </script>
@endpush
