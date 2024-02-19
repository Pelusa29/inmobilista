
@extends('layouts.user.layout')
@section('title')
<title>{{ $seo_text->title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $seo_text->meta_description }}">
@endsection
@section('user-content')

  <!--===BREADCRUMB PART START====-->
  {{-- <section class="wsus__breadcrumb" style="background: url({{ url($banner_image->image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $menus->where('id',8)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',8)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--===BREADCRUMB PART END====-->


<!--=========CONTACT PAGE START============-->
<section class="wsus__contact mt_45 mb_45">
  <div class="container">
      <div class="row">
          <div class="col-xl-4 col-md-6 col-lg-4">
              <div class="wsus__contact_single">
                  <i class="fal fa-envelope"></i>
                  <h5>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</h5>
                  <a href="javascript:;">{!! clean(nl2br($contact->emails)) !!}</a>
              </div>
          </div>
          <div class="col-xl-4 col-md-6 col-lg-4">
              <div class="wsus__contact_single">
                  <i class="far fa-phone-alt"></i>
                  <h5>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</h5>
                  <a href="javascript:;">{!! clean(nl2br($contact->phones)) !!}</a>
              </div>
          </div>
          <div class="col-xl-4 col-md-6 col-lg-4">
              <div class="wsus__contact_single md_mar">
                  <i class="fal fa-map-marker-alt"></i>
                  <h5>{{ $websiteLang->where('lang_key','address')->first()->custom_text }}</h5>
                  <a href="javascript:;">{!! clean(nl2br($contact->address)) !!}</a>
              </div>
          </div>
      </div>
      <div class="row mt_40 xs_mt_15">
          <div class="col-12">
              <div class="wsus__contact_question">
                  <h5>{{ $websiteLang->where('lang_key','contact_us')->first()->custom_text }}</h5>
                  <form method="POST" action="{{ route('contact.message') }}">
                    @csrf
                      <div class="row">
                          <div class="col-xl-6 col-lg-6">
                              <div class="wsus__con_form_single">
                                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','name')->first()->custom_text }}*" name="name">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6">
                              <div class="wsus__con_form_single">
                                  <input type="email" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}*" name="email">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6">
                              <div class="wsus__con_form_single">
                                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}*" name="subject">
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-6">
                              <div class="wsus__con_form_single">
                                  <input type="text" placeholder="{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}" name="phone">
                              </div>
                          </div>
                          <div class="col-xl-12">
                              <div class="wsus__con_form_single">
                                <textarea cols="3" rows="5" placeholder="{{ $websiteLang->where('lang_key','msg')->first()->custom_text }}*" name="message"></textarea>

                                @if($contactSetting->allow_captcha==1)
                                    <p class="g-recaptcha mb-3 mt-3" data-sitekey="{{ $contactSetting->captcha_key }}"></p>
                                @endif

                              </div>
                              <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <div class="row mt_45">
        <div class="col-12">
          <div class="wsus__con_map">
            {!! $contact->map_embed_code !!}
          </div>
      </div>
      </div>
  </div>
</section>
<!--=========CONTACT PAGE END==========-->

@endsection
