@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $user->name }}</title>
@endsection
@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
          <div class="wsus__my_profile">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_profile')->first()->custom_text }}</h4>
            <div class="wsus__dash_info">
              <div class="row">
                <div class="col-xl-4 col-sm-6 col-lg-4">
                  <div class="wsus__dash_info_img">
                    <img src="{{ $user->image ? url($user->image) : url($default_image->image) }}" alt="my images" class="img-fluid w-100">
                  </div>
                </div>
                <div class="col-xl-8 col-sm-6 col-lg-8">
                  <div class="wsus__dash_info_text">
                    <h3>{{ $user->name }}</h3>

                    @if ($user->phone)
                    <a href="callto:{{ $user->phone }}"><i class="fas fa-phone-alt"></i> {{ $user->phone }}</a>
                    @endif

                    @if ($user->email)
                    <a href="mailto:{{ $user->email }}"><i class="fas fa-envelope-open"></i> {{ $user->email }}</a>
                    @endif

                    @if ($user->website)
                    <p><i class="fas fa-globe"></i> {{ $user->website }}</p>
                    @endif

                    @if ($user->address)
                    <p><i class="fas fa-location-circle"></i> {{ $user->address }}</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="wsus__dash_info wsus__my_profile_text p_25 mt_25">
                <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</td>
                    <input type="text" placeholder="" name="name" value="{{ $user->name }}">
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</td>
                    <input type="email" placeholder="{{ $websiteLang->where('lang_key','email')->first()->custom_text }}" name="email" value="{{ $user->email }}" readonly>
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</td>
                    <input type="text" placeholder="+58412xxxxxxx" name="phone" value="{{ $user->phone }}">
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','website')->first()->custom_text }}</td>
                    <input type="text" placeholder="https://tusitioweb.com/" name="website" value="{{ $user->website }}">
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','address')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','address')->first()->custom_text }}" name="address" value="{{ $user->address }}">
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>Foto de Perfil</td>
                    <input class="file" type="file" name="image">
                  </div>
                  
                  <div class="col-12">
                    <td>Instagram</td>
                    <input type="text" placeholder="URL de perfíl de instagram" name="link_one" value="{{ $user->link_one }}">
                  </div>

                  <div class="col-12">
                    <td>Facebook</td>
                    <input type="text" placeholder="URL de perfil de facebook" name="link_two" value="{{ $user->link_two }}">
                  </div>

                  <div class="col-12">
                    <td>TikTok</td>
                    <input type="text" placeholder="URL de perfil de tiktok" name="link_three" value="{{ $user->link_three }}">
                  </div>

                  <div class="col-12">
                    <td>Youtube</td>
                    <input type="text" placeholder="URL de perfil de youtube" name="link_four" value="{{ $user->link_four }}">
                  </div>

                  {{-- <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','first_icon')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','first_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_one" value="{{ $user->icon_one }}">
                  </div>
                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','first_link')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','first_link')->first()->custom_text }}" name="link_one" value="{{ $user->link_one }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','second_icon')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','second_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_two" value="{{ $user->icon_two }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','second_link')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','second_link')->first()->custom_text }}" name="link_two" value="{{ $user->link_two }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','third_icon')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','third_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_three" value="{{ $user->icon_three }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','third_link')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','third_link')->first()->custom_text }}" name="link_three" value="{{ $user->link_three }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','four_icon')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','four_icon')->first()->custom_text }}" class="custom-icon-picker" name="icon_four" value="{{ $user->icon_four }}">
                  </div>

                  <div class="col-xl-6 col-md-6">
                      <td>{{ $websiteLang->where('lang_key','four_link')->first()->custom_text }}</td>
                    <input type="text" placeholder="{{ $websiteLang->where('lang_key','four_link')->first()->custom_text }}" name="link_four" value="{{ $user->link_four }}">
                  </div> --}}

                  <div class="col-12">
                      <td>Sobre ti</td>
                    <textarea placeholder="Una breve descrición de ti"class="form-control summer_note" name="about">{{ $user->about }}</textarea>
                  </div>
                  
                      <!-- Seccion KYC -->
                  
                  <br><br><br>
                  <h5 class="heading">Registro KYC</h5>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Estado de KYC:</td><br>
                   <td>
                     @if ($user->status_kyc==1)  
                          <span class="custom-badge">Su Verificacion KYC esta aprobada!</span>
                     @else
                          <span class="custom-badge">Su Verificacion KYC aun no esta aprobada!<br>Debe verificarse para realizar publicaciones.<br>El proceso puede tardar hasta 24h en aprobarse.</span>
                     @endif
                     </td>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <td>Cedula de Identidad</td>
                    <input type="number" placeholder="Introduzca su cedula" name="documento" value="{{ $user->documento }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Primer Nombre</td>
                    <input type="text" placeholder="Introduzca su primer nombre" name="pn" value="{{ $user->pn }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Segundo Nombre</td>
                    <input type="text" placeholder="Introduzca su segundo nombre" name="sn" value="{{ $user->sn }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Primer Apellido</td>
                    <input type="text" placeholder="Introduzca su primer apellido" name="pa" value="{{ $user->pa }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Segundo Apellido</td>
                    <input type="text" placeholder="Introduzca su segundo apellido" name="sa" value="{{ $user->sa }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Fecha de Nacimiento</td>
                    <input type="date" placeholder="Especifique su fecha de nacimiento" name="Nacimiento" value="{{ $user->Nacimiento }}">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Foto selfie con documento visible</td>
                    <input class="file" type="file" name="selfie">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Foto de frente del documento de identidad</td>
                    <input class="file" type="file" name="fotodocfrente">
                  </div>
                  
                  <div class="col-xl-6 col-md-6">
                    <td>Foto del reverso del documento de identidad</td>
                    <input class="file" type="file" name="fotodocatras">
                  </div>
                  
                  

                  
                  <div class="col-12">
                    <button type="submit" class="common_btn mt-4">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                  </div>
                  
                  
 
            
            
            
            <div class="row">
              <div class="col-xl-6">
                <div class="wsus__dash_info p_25 mt_25">
                    <form action="{{ route('user.update.password') }}" method="POST" class="wsus__dash_change_pass">
                        @csrf
                    <div class="row">
                      <div class="col-12 col-md-6 col-xl-12">
                        <label class="my-1" for="">{{ $websiteLang->where('lang_key','old_pass')->first()->custom_text }}</label>
                        <input type="password" name="current_password">
                      </div>
                      <div class="col-12 col-md-6 col-xl-12">
                        <label class="my-1" for="">{{ $websiteLang->where('lang_key','new_pass')->first()->custom_text }}</label>
                        <input type="password" name="password">
                      </div>
                      <div class="col-12">
                        <label class="my-1" for="">{{ $websiteLang->where('lang_key','confirm_pass')->first()->custom_text }}</label>
                        <input type="password" name="password_confirmation">
                      </div>
                      <div class="col-12">
                        <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','change_pass')->first()->custom_text }}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-xl-6">
                    <form action="{{ route('user.update.profile.banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="wsus__dash_info wsus__dash_banner_img p_25 mt_25">
                            <h5 class="sub_heading">{{ $websiteLang->where('lang_key','exist_banner_img')->first()->custom_text }}</h5>
                            <div class="wsus__dash_banner_main">
                                <img src="{{ $user->banner_image ? url($user->banner_image ) : url($agent_default_profile->image) }}" alt="banner img" class="img-fluid w-100">
                            </div>
                            <label>{{ $websiteLang->where('lang_key','new_img')->first()->custom_text }}</label>
                            <input type="file" name="banner_image">
                            <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                        </div>
                    </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
