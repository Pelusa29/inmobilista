@php
    $setting=App\Setting::first();
    $websiteLang=App\ManageText::all();
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    @yield('title')
    <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;900&family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/add_row_custon.css') }}">

    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/iconpicker/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

    @if ($setting->text_direction=="RTL")
        <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">
    @include('user.theme_style')

    <!--jquery library js-->
    <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('user/js/sweetalert2@11.js') }}"></script>

    <style>
        .fade.in {
            opacity: 1 !important;
        }
        .ck-content {
            min-height: 6rem !important;
        }
    </style>
</head>

<body>

@php
    $user=Auth::guard('web')->user();
    $default_image=App\BannerImage::find(15);
@endphp

  <!--============================
    DASHBOARD PAGE START
  ==============================-->
  <section class="wsus__dashboard">
      <div class="container-fluid">
          <span class="wsus__menu_icon"><i class="fas fa-bars"></i></span>
          <div class="wsus__dashboard_side_bar">
            <span class="wsus__close_icon"><i class="fas fa-times"></i></span>
            <a class="wsus__dashboard_logo" style="background : #6610f2" href="{{ route('home') }}">
                <img src="{{ asset($setting->logo) }}" alt="logo" class="img-fluid">
              </a>
              <div class="wsus__agent_img">
                  <img src="{{ $user->image ? url($user->image) : url($default_image->image) }}" alt="agent" class="img-fluid">
                  <h5>{{ $user->name }}</h5>
              </div>
              <ul class="wsus__deshboard_menu">
                    <li><a class="{{ Route::is('user.dashboard') ? 'dash_active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fal fa-fw fa-tachometer-alt"></i> {{ $websiteLang->where('lang_key','dashboard')->first()->custom_text }}</a></li>

                    <li><a href="{{ route('home') }}"><i class="fal fa-globe"></i> {{ $websiteLang->where('lang_key','go_to_homepage')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my.properties') || Route::is('user.property.edit') || Route::is('user.create.property') ? 'dash_active' : '' }}" href="{{ route('user.my.properties') }}"><i class="far fa-list"></i> {{ $websiteLang->where('lang_key','my_property')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my-profile') ? 'dash_active' : '' }}" href="{{ route('user.my-profile') }}"><i class="fas fa-user-tie"></i> {{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</a></li>

                    <li><a  class="{{ Route::is('user.my-order') || Route::is('user.order.details') ? 'dash_active' : '' }}" href="{{ route('user.my-order') }}"><i class="far fa-list"></i> {{ $websiteLang->where('lang_key','order')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.my-wishlist') ? 'dash_active' : '' }}" href="{{ route('user.my-wishlist') }}"><i class="fas fa-heart"></i> {{ $websiteLang->where('lang_key','wishlist')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.pricing.plan') ? 'dash_active' : '' }}" href="{{ route('user.pricing.plan') }}"><i class="fas fa-box-full"></i> {{ $websiteLang->where('lang_key','pricing_plan')->first()->custom_text }}</a></li>



                    <li><a class="{{ Route::is('user.my-review') || Route::is('user.edit-review') ? 'dash_active' : '' }}" href="{{ route('user.my-review') }}"><i class="fas fa-star"></i> {{ $websiteLang->where('lang_key','my_review')->first()->custom_text }}</a></li>

                    <li><a class="{{ Route::is('user.client-review') ? 'dash_active' : '' }}" href="{{ route('user.client-review') }}"><i class="fas fa-star"></i> {{ $websiteLang->where('lang_key','client_review')->first()->custom_text }}</a></li>

                    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> {{ $websiteLang->where('lang_key','logout')->first()->custom_text }}</a></li>
              </ul>
          </div>
