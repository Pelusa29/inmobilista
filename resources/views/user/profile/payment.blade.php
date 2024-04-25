@extends('layouts.user.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</title>
@endsection
@section('meta')
    <meta name="description" content="lorem ipsum">
@endsection

@section('user-content')

  <!--===BREADCRUMB PART START====-->
  <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!--===BREADCRUMB PART END====-->


  <!--=====CHECKOUT START=====-->
  <section class="wsus__checkout mt_45 mb_45">
    <div class="container">
      <div class="row">
        <div class="col-xl-2 col-lg-3">
          <div class="wsus__pay_method" id="sticky_sidebar">
            <h5>{{ $websiteLang->where('lang_key','payment_method')->first()->custom_text }}</h5>
            <div class="d-flex align-items-start">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                @if ($paymentSetting->stripe_status==2)
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ $websiteLang->where('lang_key','stripe')->first()->custom_text }}</button>
                @endif

                @if ($paymentSetting->paypal_status==1)
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{ $websiteLang->where('lang_key','paypal')->first()->custom_text }}</button>
                @endif

                @if ($zinli)
                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">{{ $websiteLang->where('lang_key','zinli')->first()->custom_text }}</button>
                @endif

                @if ($binance)
                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">{{ $websiteLang->where('lang_key','binance')->first()->custom_text }}</button>
                @endif

                @if ($paymentSetting->bank_status==1)
                <button class="nav-link" id="v-pills-settings-tab2" data-bs-toggle="pill" data-bs-target="#v-pills-settings2" type="button" role="tab" aria-controls="v-pills-settings2" aria-selected="false">{{ $websiteLang->where('lang_key','bank_payment')->first()->custom_text }}</button>
                @endif

              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-5 col-lg-4">
          <div class="wsus__pay_details" id="sticky_sidebar2">
            <h5>{{ $websiteLang->where('lang_key','payment_detail')->first()->custom_text }}</h5>
            <div class="tab-content" id="v-pills-tabContent">
                @if ($paymentSetting->stripe_status==2)
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="wsus__pay_card">
                        <form action="{{ route('user.stripe.payment',$package->id) }}" method="POST" class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ $stripe->stripe_key }}"
                            id="payment-form">
                            @csrf

                            <div class="row">
                                <div class="col-xl-12">
                                    <label>{{ $websiteLang->where('lang_key','card_number')->first()->custom_text }}</label>
                                    <input type="text" name="card_number" class="card-number">
                                </div>
                                <div class="col-xl-12">
                                    <label>{{ $websiteLang->where('lang_key','cvc')->first()->custom_text }}</label>
                                    <input type="text" name="cvc" class="card-cvc">
                                </div>
                                <div class="col-xl-6">
                                    <label>{{ $websiteLang->where('lang_key','exp_month')->first()->custom_text }}</label>
                                    <input type="text" name="month" class="card-expiry-month">
                                </div>
                                <div class="col-xl-6">
                                    <label>{{ $websiteLang->where('lang_key','exp_year')->first()->custom_text }}</label>
                                    <input type="text" name="year" class="card-expiry-year">
                                </div>

                                <div class='col-xl-12'>
                                    <div class='error d-none form-group '>
                                        <div class='alert-danger alert '>{{ $websiteLang->where('lang_key','valid_card')->first()->custom_text }}</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                @endif

                @if ($paymentSetting->paypal_status==1)
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="text-align: center;">
                        {{-- <a href="{{ route('user.paypal',$package->id) }}" class="common_btn mt_25">{{ $websiteLang->where('lang_key','pay_with_paypal')->first()->custom_text }}</a> --}}
                        <a href="{{ route('user.paypal',$package->id) }}" class="">
                            <div id="paypal-button-container" style="max-width:1000px;"></div>
                        </a>
                    </div>
                @endif
                {{--  @if ($zinli)
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <a href="javascript:;" onClick="makePayment()" class="common_btn mt_25">{{ $websiteLang->where('lang_key','pay_with_flutterwave')->first()->custom_text }}</a>
                    </div>
                @endif --}}
                 @if ($binance)
                   <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <a href="javascript:;" type="button" class="common_btn mt_25" id="paymentbinance">{{ $websiteLang->where('lang_key','pay_with_binance')->first()->custom_text }}</a>
                    </div>
                @endif
                @if ($zinli)
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <a href="javascript:;" type="button" class="common_btn mt_25" id="paymentzinli">{{ $websiteLang->where('lang_key','pay_with_zinli')->first()->custom_text }}</a>
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onClick="payzinli()">
                            Opern Modal
                        </button> --}}
                    </div>
                @endif

                {{-- @if ($flutterwave->status == 1)
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <a href="javascript:;" onClick="makePayment()" class="common_btn mt_25">{{ $websiteLang->where('lang_key','pay_with_flutterwave¿')->first()->custom_text }}</a>
                    </div>
                @endif --}}

               {{--  <div class="tab-pane fade" id="paystackTab" role="tabpanel" aria-labelledby="paystack-tab">
                    <a href="javascript:;" class="common_btn mt_25" onclick="payWithPaystack()">{{ $websiteLang->where('lang_key','pay_with_paystack')->first()->custom_text }}</a>
                </div>

                <div class="tab-pane fade" id="mollieTab" role="tabpanel" aria-labelledby="mollie-tab">
                    <a href="{{ route('user.mollie-payment', $package->id) }}" class="common_btn mt_25">{{ $websiteLang->where('lang_key','pay_with_mollie')->first()->custom_text }}</a>
                </div>

                <div class="tab-pane fade" id="instamojoTab" role="tabpanel" aria-labelledby="instamojo-tab">
                    <a href="{{ route('user.pay-with-instamojo', $package->id) }}" class="common_btn mt_25">{{ $websiteLang->where('lang_key','pay_with_instamojo')->first()->custom_text }}</a>
                </div> --}}



                @if ($paymentSetting->bank_status==1)
                    <div class="tab-pane fade" id="v-pills-settings2" role="tabpanel" aria-labelledby="v-pills-settings-tab2">
                        <p>{!! clean(nl2br(e($stripe->bank_account))) !!}</p>

                        <form action="{{ route('user.bank-payment') }}" method="POST">
                            @csrf
                            <div class="wsus__con_form_single mt_25">
                                <textarea placeholder="{{ $websiteLang->where('lang_key','trans_info')->first()->custom_text }}" name="tran_id"  id="" required></textarea>
                            </div>
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
                        </form>
                    </div>
                @endif

            </div>
          </div>
        </div>
        <div class="col-xl-5 col-lg-5">
          <div class="wsus__package_details">
            <h5>{{ $websiteLang->where('lang_key','package_detail')->first()->custom_text }}</h5>
            <div class="table-responsive main_table">
                <table class="table">
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','package_name')->first()->custom_text }}</td>
                        <td width="50%">{{ $package->package_name }}</td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</td>
                        <td width="50%">{{ $currency->currency_icon }}{{ $package->price }}</td>
                    </tr>

                     <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_days==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ date('Y-m-d', strtotime($package->number_of_days.' days')) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_property==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_property }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_aminities==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_aminities }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_nearest_place==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_nearest_place }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','photo')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_photo==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_photo }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->is_featured==1)
                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                            @else
                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_feature_property==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_feature_property }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->is_top==1)
                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                            @else
                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_top_property==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_top_property }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->is_urgent==1)
                            {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                            @else
                            {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                        <td width="50%">
                            @if ($package->number_of_urgent_property==-1)
                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                            @else
                                {{ $package->number_of_urgent_property }}
                            @endif
                        </td>
                    </tr>

                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
   {{-- Modal Payment--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario de Pago Zinli</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.zinli-payment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="wsus__con_form_single mt_25">
                                <label for="tranc_id">Id Transacciónal</label>
                                <input placeholder="{{ $websiteLang->where('lang_key','trans_info')->first()->custom_text }}" name="transaction"  id="" required />
                            </div>
                            <div class="wsus__con_form_single mt_25">
                                <label for="email">Correo Electronico</label>
                                <input type="email" placeholder="Email" name="email" id="" required>
                            </div>
                            <div class="wsus__con_form_single mt_25">
                                <label for="evidence">Evidencia</label>
                                <input type="file" placeholder="Evidencia" name="file_input" id="">
                            </div>
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnClosePayments">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="binanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulario de Pago Binance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.binance-payment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="wsus__con_form_single mt_25">
                                <label for="tranc_id">Id Transacciónal</label>
                                <input placeholder="{{ $websiteLang->where('lang_key','trans_info')->first()->custom_text }}" name="transaction"  id="" required />
                            </div>
                            <div class="wsus__con_form_single mt_25">
                                <label for="email">Correo Electronico</label>
                                <input type="email" placeholder="Email" name="email" id="" required>
                            </div>
                            <div class="wsus__con_form_single mt_25">
                                <label for="evidence">Evidencia</label>
                                <input type="file" placeholder="Evidencia" name="file_input" id="">
                            </div>
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','payment')->first()->custom_text }}</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btnCloseBinancePayments">Close</button>
                    </div>
                </div>
            </div>
        </div>

  <!--=====CHECKOUT END=====-->

<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>

<script>
    // stripe
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form         = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]',
                                'input[type=text]', 'input[type=file]',
                                'textarea'].join(', '),
            $inputs       = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid         = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

        /* Payment Modal */
        $("#paymentzinli").click(function(){
            $('#exampleModal').find('form').trigger('reset');
            $('#exampleModal').modal('show');
        });

         $("#paymentbinance").click(function(){
            $('#binanceModal').find('form').trigger('reset');
            $('#binanceModal').modal('show');
        });

        $("#btnClosePayments").click(function(){
            //Reset Form
            $('#exampleModal').find('form').trigger('reset');
            $('#exampleModal').modal('hide');
        });

        $("#btnCloseBinancePayments").click(function(){
            //Reset Form
            $('#binanceModal').find('form').trigger('reset');
            $('#binanceModal').modal('hide');
        });

        /* $('#exampleModal').modal('show'); */
    });
</script>
<script>
  paypal.Buttons({
      style: {
          shape: 'rect',
          color: 'gold',
          layout: 'horizontal',
          label: 'buynow',

      }
  }).render('#paypal-button-container');
</script>

@php
    $payable_amount = $package_price * $flutterwave->currency_rate;
    $payable_amount = round($payable_amount, 2);
@endphp


@php
    $public_key = $paystack->paystack_public_key;
    $currency = $paystack->paystack_currency_code;
    $currency = strtoupper($currency);

    $ngn_amount = $package_price * $paystack->paystack_currency_rate;
    $ngn_amount = $ngn_amount * 100;
    $ngn_amount = round($ngn_amount);
@endphp


<script>
    function makePayment() {
      FlutterwaveCheckout({
        public_key: "{{ $flutterwave->public_key }}",
        tx_ref: "RX1",
        amount: {{ $payable_amount }},
        currency: "{{ $flutterwave->currency_code }}",
        country: "{{ $flutterwave->country_code }}",
        payment_options: " ",
        customer: {
          email: "{{ $user->email }}",
          phone_number: "{{ $user->phone }}",
          name: "{{ $user->name }}",
        },
        callback: function (data) {
            var tnx_id = data.transaction_id;
            var _token = "{{ csrf_token() }}";
            var package_id = '{{ $package->id }}';
            $.ajax({
                type: 'post',
                data : {tnx_id,_token,package_id},
                url: "{{ url('user/flutterwave-payment/') }}",
                success: function (response) {
                    if(response.status == 'success'){
                        toastr.success(response.message);
                        window.location.href = "{{ route('user.my-order') }}";
                    }else{
                        toastr.error(response.message);
                        window.location.reload();

                    }
                },
                error: function(err) {}
            });

        },
        customizations: {
          title: "{{ $flutterwave->title }}",
          logo: "{{ asset($flutterwave->logo) }}",
        },
      });
    }


function payWithPaystack() {
    var package_id = '{{ $package->id }}';
  var handler = PaystackPop.setup({
    key: '{{ $public_key }}',
    email: '{{ $user->email }}',
    amount: '{{ $ngn_amount }}',
    currency: "{{ $currency }}",
    callback: function(response){
      let reference = response.reference;
      let tnx_id = response.transaction;
      let _token = "{{ csrf_token() }}";
      $.ajax({
          type: "post",
          data: {reference, tnx_id, _token, package_id},
          url: "{{ route('user.paystack-payment') }}",
          success: function(response) {
            if(response.status == 'success'){
                window.location.href = "{{ route('user.my-order') }}";
            }else{
                window.location.reload();
            }
          }
      });
    },
    onClose: function(){
        alert('window closed');
    }
  });
  handler.openIframe();
}

  </script>
@endsection
