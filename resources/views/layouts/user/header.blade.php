@php
    $topbar_contact=App\ContactUs::first();
    $setting=App\Setting::first();
    $customPages=App\CustomPage::all();
    $navigations=App\Navigation::all();
    $websiteLang=App\ManageText::all();
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    @yield('title')
    @yield('meta')


    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;900&family=Poppins:wght@400;500;600;900&display=swap" rel="stylesheet">

  <link rel="icon" type="image/png" href="{{ url($setting->favicon) }}">
  <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/spacing.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/add_row_custon.css') }}">


  <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('user/css/responsive.css') }}">

  @if ($setting->text_direction=="RTL")
    <link rel="stylesheet" href="{{ asset('user/css/rtl.css') }}">
  @endif

  <link rel="stylesheet" href="{{ asset('user/css/dev.css') }}">

  <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

  <style>
    .wsus__banner_search_agent {
        background: rgb(69, 0, 131);
        padding: 20px;
        border-radius: 5px;
        width: 730px;
    }

    .wsus__banner_search_agent h4 {
        color: #ffffff;
        text-transform: capitalize;
        font-size: 23px;
        font-weight: 600;
        text-align: center;
    }
  </style>

  @include('user.theme_style')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('user/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('user/js/sweetalert2@11.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    @if ($setting->google_analytic==1)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $setting->google_analytic_code }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $setting->google_analytic_code }}');
    </script>
    @endif

</head>

<body>

  <!--=====TOPBAR START=====-->
  <section class="wsus__topbaro">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-12 col-sm-8">
          <ul class="wsus__topbar_lefto d-flex align-items-center">
            {{-- <li><a href="callto:{{ $topbar_contact->topbar_phone }}" ><i class="fal fa-mobile"></i> {{ $topbar_contact->topbar_phone }}</a></li> --}}
            <li><a href="maolto:{{ $topbar_contact->topbar_email }}" ><i class="fas fa-envelope"></i> {{ $topbar_contact->topbar_email }}</a></li>
          </ul>
        </div>
        <div class="col-xl-6 col-sm-4 d-none d-sm-block">
          <ul class="wsus__topbar_right d-flex justify-content-end align-items-center">
                @if ($topbar_contact->facebook)
                <li><a href="{{ $topbar_contact->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                @endif
                @if ($topbar_contact->twitter)
                <li><a href="{{ $topbar_contact->twitter }}"><i class="fab fa-twitter"></i></a></li>
                @endif
               
                @if ($topbar_contact->instagram)
                <li><a href="{{ $topbar_contact->instagram }}"><i class="fab fa-instagram"></i></a></li>
                @endif
               
            </ul>
        </div>
      </div>
    </div>
  </section>
  <!--=====TOPBAR END=====-->


  <!--=====MAIN MENU START=====-->
  <nav class="navbar navbar-expand-lg main_menu">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ url($setting->logo) }}" alt="logo" class="img-fluid w-100">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fal fa-align-right"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">

            @php
                $home_menu=$navigations->where('id',1)->first();
            @endphp
            @if ($home_menu->status==1)
            {{-- <li class="nav-item">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ $home_menu->navbar }}</a>
            </li> --}}
            @endif

            @php
                $about_menu=$navigations->where('id',4)->first();
            @endphp
            @if ($about_menu->status==1)
            <li class="nav-item">
                <a class="nav-link {{ Route::is('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">{{ $about_menu->navbar }}</a>
            </li>
            @endif

            @php
                $property_menu=$navigations->where('id',2)->first();
            @endphp
            @if ($property_menu->status==1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('properties') || Route::is('agents') ? 'active' : '' }}" href="javascript:;" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ $property_menu->navbar }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @php
                            $all_property_menu=$navigations->where('id',3)->first();
                        @endphp
                        @if ($all_property_menu->status==1)
                        <li><a class="dropdown-item" href="{{ route('properties',['page_type' => 'list_view']) }}">{{ $all_property_menu->navbar }}</a></li>
                        @endif

                        @php
                            $featured_property_menu=$navigations->where('id',19)->first();
                        @endphp

                        @if ($featured_property_menu->status==1)
                        <li><a class="dropdown-item" href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>3]) }}">{{ $featured_property_menu->navbar }}</a></li>
                        @endif

                        @php
                            $top_property_menu=$navigations->where('id',20)->first();
                        @endphp
                        @if ($top_property_menu->status==1)
                        <li><a class="dropdown-item" href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>4]) }}">{{ $top_property_menu->navbar }}</a></li>
                        @endif

                        @php
                            $urgent_property_menu=$navigations->where('id',21)->first();
                        @endphp
                        @if ($urgent_property_menu->status==1)
                        <li><a class="dropdown-item" href="{{ route('properties',['page_type' => 'list_view','sorting_id'=>6]) }}">{{ $urgent_property_menu->navbar }}</a></li>
                        @endif
                        @php
                            $agent_menu=$navigations->where('id',6)->first();
                        @endphp
                        @if ($agent_menu->status==1)
                        <li><a class="dropdown-item" href="{{ route('agents') }}">{{ $agent_menu->navbar }}</a></li>
                        @endif

                    </ul>
                </li>
            @endif

            @php
                $pricing_menu=$navigations->where('id',5)->first();
            @endphp
            @if ($pricing_menu->status==1)
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('pricing.plan') ? 'active' : '' }}" href="{{ route('pricing.plan') }}">{{ $pricing_menu->navbar }}</a>
                </li>
            @endif

            @php
                $pages_menu=$navigations->where('id',18)->first();
            @endphp
            @if ($pages_menu->status==1)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('blog') || Route::is('blog.details') || Route::is('custom.page') || Route::is('faq') ? 'active' : '' }}" href="javascript:;" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ $pages_menu->navbar }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @php
                        $faq_menu=$navigations->where('id',17)->first();
                    @endphp
                    @if ($faq_menu->status==1)
                    <li><a class="dropdown-item {{ Route::is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">{{ $faq_menu->navbar }}</a></li>
                    @endif

                    @php
                        $blog_menu=$navigations->where('id',7)->first();
                    @endphp
                    @if ($blog_menu->status==1)
                    <li>
                        <a class="dropdown-item {{ Route::is('blog') || Route::is('blog.details') ? 'active' : '' }}" href="{{ route('blog') }}">{{ $blog_menu->navbar }}</a>
                    </li>
                    @endif

                    @if ($customPages->count() !=0)
                        @foreach ($customPages as $custom_item)
                            <li><a class="dropdown-item {{  Request::url() == route('custom.page',$custom_item->slug) ? 'active' : '' }}" href="{{ route('custom.page',$custom_item->slug) }}">{{ $custom_item->page_name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </li>
            @endif


            @php
                $contact_menu=$navigations->where('id',8)->first();
            @endphp
            @if ($contact_menu->status==1)
            <li class="nav-item">
                <a class="nav-link {{ Route::is('contact-us')? 'active' : '' }}" href="{{ route('contact.us') }}">{{  $contact_menu->navbar }}</a>
            </li>
            @endif
            

        </ul>
        <ul class="login_icon ms-auto">
                <li><a href="https://inmobalista.com/user/create-property"><i class="fal fa-sharp fa-solid fa-thumbtack"></i> ANUNCIA TU PROPIEDAD!  </a>
                </li>
                
            </ul>
            <ul class="login_icon ms-auto">
                <li><a href="{{ route('agents') }}"><i class="fal fa-solid fa-users"></i> AGENTES  </a>
                </li>
                
            </ul>

        @php
            $my_account =$navigations->where('id',22)->first();
        @endphp
        @if ($my_account ->status==1)
            <ul class="login_icon ms-auto">
                <li><a href="{{ route('user.dashboard') }}"><i class="fal fa-user-circle"></i> {{ $my_account->navbar }}</a>
                </li>
                
            </ul>
        @endif
      </div>
    </div>
  </nav>
  <!--=====MAIN MENU END=====-->
