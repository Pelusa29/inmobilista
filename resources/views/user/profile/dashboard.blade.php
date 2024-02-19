@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</title>
@endsection

@section('user-dashboard')
<div class="row">
    <div class="col-12 col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
            <div class="wsus__manage_dashboard">
                <h4 class="heading">{{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</h4>
                <div class="row">
                    <div class="col-xl-4 col-sm-6 col-md-4">
                        <div class="wsus__manage_single">
                            <i class="far fa-list"></i>
                            <span>{{ $publishProperty }}</span>
                            <p>{{ $websiteLang->where('lang_key','publish_pro')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-md-4">
                        <div class="wsus__manage_single green">
                          <i class="fab fa-buromobelexperte"></i>
                            <span>{{ $expiredProperty }}</span>
                            <p>{{ $websiteLang->where('lang_key','expired_pro')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-md-4">
                        <div class="wsus__manage_single sky">
                            <i class="far fa-list"></i>
                            <span>{{ $myReviews->count() }}</span>
                            <p>{{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-md-4">
                      <div class="wsus__manage_single blue">
                          <i class="far fa-list"></i>
                          <span>{{ $clientReviews }}</span>
                          <p>{{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</p>
                      </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-md-4">
                        <div class="wsus__manage_single orange">
                            <i class="far fa-list"></i>
                            <span>{{ $wishlists->count() }}</span>
                            <p>{{ $websiteLang->where('lang_key','wishlist')->first()->custom_text }}</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 col-md-4">
                        <div class="wsus__manage_single purple">
                            <i class="far fa-list"></i>
                            <span>{{ $orders->count() }}</span>
                            <p>{{ $websiteLang->where('lang_key','order')->first()->custom_text }}</p>
                        </div>
                    </div>
                    @if ($activeOrder)
                    <div class="col-xl-12">
                        @php
                            $package=$activeOrder->package;
                        @endphp
                      <div class="wsus__package_details">
                        <h5 class="sub_heading">{{ $websiteLang->where('lang_key','active_order')->first()->custom_text }}</h5>
                        <div class="table-responsive">
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
                                        @if ($activeOrder->expired_day==-1)
                                            {{ $websiteLang->where('lang_key','unlimited')->first()->custom_text }}
                                        @else
                                            {{ $activeOrder->expired_date }}
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
                    @endif
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none">
            Launch demo modal
        </button>

    </div>
</div>



  <!-- Modal -->
  <div class="modal fade" id="codeModal" tabindex="-1" aria-labelledby="codeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('user.purchase.code') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="codeModalLabel">Si tienes un cupón usalo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                      <div class="">
                          <label for="code" class="form-label">Código</label>
                          <input type="text" name="code" id="code" class="form-control" required>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ahora no</button>
                <button type="submit" class="btn btn-primary">Usar código</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  @if ( !is_null($activeOrder) )
    <script>
        $(document).ready(function () {
            $('#codeModal').modal('show');
        });
    </script>
  @endif
  <script>
    
  </script>
@endsection
