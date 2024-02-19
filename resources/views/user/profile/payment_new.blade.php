@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','pricing_plan')->first()->custom_text }}</title>
@endsection
@section('user-dashboard')

<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <div class="wsus__my_property">
                <h4 class="heading" style="margin-bottom: 40px;">Plan {{ $package->package_name }}</h4>
                
                <div class="row">
                    
                    <!-- PAYMENT --->
                    <div class="col-xl-6 col-xxl-4 col-md-6 col-lg">
                        <h5 style="margin-bottom: 20px;">Método de pago (transferencia bancaria)</h5>

                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 100px"><strong>BANCO</strong></td>
                                <td><p>BBVA Provincial</p></td>
                            </tr>
                            <tr>
                                <td style="width: 100px"><strong>CUENTA</strong></td>
                                <td><p>5896 5987 8878 3698</p></td>
                            </tr>
                            <tr>
                                <td style="width: 100px"><strong>REF</strong></td>
                                <td><p>123456789</p></td>
                            </tr>
                            <tr>
                                <td style="width: 100px"><strong>CANTIDAD</strong></td>
                                <td><p>{{ $currency->currency_icon }}{{ $price }}</p></td>
                            </tr>
                        </table>

                        <form action="{{ route('user.purchase.transfer', $package->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div style="margin-top:100px;">
                                <label for="">Código de descuento <span style="color:#626262">(opcional)</span></label>
                                <input id="promotional_code" name="promotional_code" class="form-control" type="text" placeholder="Código de promoción" value="{{ $code }}">
                            </div>

                            <div style="margin-top:50px;">
                                <label for="">Número de transacción u operación</label>
                                <input id="transaction" name="transaction" class="form-control" type="text" placeholder="12 dígitos">
                            </div>
    
                            <div class="row" style="margin-top:10px;">
                                <div class="col-9">
                                    <label for="">Comprobante de pago</label>
                                    <input id="file" name="file" class="form-control" type="file" accept="image/png,image/jpeg">
                                </div>
                                <div class="col-3" style="text-align: right;">
                                    <button type="submit" class="btn btn-info mt-4">Enviar</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>

                    <!-- PACKAGE DETAILS --->
                    <div class="col-xl-6 col-xxl-4 col-md-6 col-lg">
                        <h5 style="margin-bottom: 20px;">{{ $websiteLang->where('lang_key','package_detail')->first()->custom_text }}</h5>

                        <div class="table-responsive main_table">
                            <table class="table table-striped">
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','package_name')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">{{ $package->package_name }}</td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','price')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">{{ $currency->currency_icon }}{{ $package->price }}</td>
                                </tr>
            
                                    <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','expired_date')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_days==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ date('Y-m-d', strtotime($package->number_of_days.' days')) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_property }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','aminity')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_aminities==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_aminities }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_nearest_place==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_nearest_place }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','photo')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_photo==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_photo }}
                                        @endif
                                    </td>
                                </tr>
            
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->is_featured==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','featured_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_feature_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_feature_property }}
                                        @endif
                                    </td>
                                </tr>
            
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->is_top==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','top_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->number_of_top_property==-1)
                                        {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $package->number_of_top_property }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
                                        @if ($package->is_urgent==1)
                                        {{ $websiteLang->where('lang_key','available')->first()->custom_text }}
                                        @else
                                        {{ $websiteLang->where('lang_key','not_available')->first()->custom_text }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" style="padding: 5px 0px;">{{ $websiteLang->where('lang_key','urgent_property')->first()->custom_text }}</td>
                                    <td width="50%" style="padding: 5px 0px;">
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
    </div>
</div>

@endsection