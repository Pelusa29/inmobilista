@extends('layouts.user.layout')
@section('title')
    <title>{{ $property->seo_title }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ $property->seo_description }}">
@endsection
@section('user-content')
     <!--===BREADCRUMB PART START====-->
  {{-- <section class="wsus__breadcrumb" style="background: url({{ url($property->banner_image) }});">
    <div class="wsus_bread_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h4>{{ $menus->where('id',2)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',2)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
  </section> --}}
  <!--===BREADCRUMB PART END====-->


  <!--=====PROPERTY DETAILD START=====-->
  <section class="wsus__property_details mt_45 mb_20">
    <div class="container">
      <div class="row pro_det_slider">
        @foreach ($property->propertyImages as $imag_item)
            <div class="col-12">
                <div class="pro_det_slider_item">
                    <img src="{{ url($imag_item->image) }}" alt="property" class="img-fluid w-100">
                </div>
            </div>
        @endforeach
      </div>
      <div class="row mt_40">
        <div class="col-xl-8 col-lg-7">
            <div class="wsus__property_det_content">
                    <div class="row">
                        <div class="col-12">
                            <div class="wsus__single_details pb-sm-2">
                            <div class="wsus__single_det_top d-flex justify-content-between">
                                <p>
                                    <span class="sale">{{ $property->propertyPurpose->custom_purpose }}</span>
                                    @if ($property->urgent_property==1)
                                        <span class="rent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                    @endif
                                </p>


                                @if ($property->property_purpose_id==1)
                                    <span class="tk">{{ $currency->currency_icon }}{{ $property->price }}</span>
                                @elseif ($property->property_purpose_id==2)
                                    <span class="tk">{{ $currency->currency_icon }}{{ $property->price }} /
                                        @if ($property->period=='Daily')
                                        <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                                        @elseif ($property->period=='Monthly')
                                        <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                                        @elseif ($property->period=='Yearly')
                                        <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                                        @endif
                                    </span>
                                @endif

                            </div>
                            <h4>{{ $property->title }}</h4>

                            @php
                                $total_review=$property->reviews->where('status',1)->count();
                                if($total_review > 0){
                                    $avg_sum=$property->reviews->where('status',1)->sum('avarage_rating');

                                    $avg=$avg_sum/$total_review;
                                    $intAvg=intval($avg);
                                    $nextVal=$intAvg+1;
                                    $reviewPoint=$intAvg;
                                    $halfReview=false;
                                    if($intAvg < $avg && $avg < $nextVal){
                                        $reviewPoint= $intAvg + 0.5;
                                        $halfReview=true;
                                    }
                                }
                            @endphp
                            @if ($total_review > 0)
                            <p class="wsus__pro_det_top_rating">
                                @for ($i = 1; $i <=5; $i++)
                                    @if ($i <= $reviewPoint)
                                        <i class="fas fa-star"></i>
                                    @elseif ($i> $reviewPoint )
                                        @if ($halfReview==true)
                                        <i class="fas fa-star-half-alt"></i>
                                            @php
                                                $halfReview=false
                                            @endphp
                                        @else
                                        <i class="fal fa-star"></i>
                                        @endif
                                    @endif
                                @endfor
                                <span>{{ sprintf("%.1f", $reviewPoint) }}</span>
                            </p>
                            @else
                            <p class="wsus__pro_det_top_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>0.0</span>
                            </p>

                            @endif
                            <p> {{ $property->address.', '. $property->city->name.', '.$property->city->countryState->name.', '.$property->city->countryState->country->name }}</p>
                            <ul class="item d-flex flex-wrap mt-3">
                                <li><i class="fal fa-bed"></i> {{ $property->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                <li><i class="fal fa-shower"></i> {{ $property->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                <li><i class="fal fa-draw-square"></i> {{ $property->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                            </ul>
                            <ul class="list d-flex flex-wrap">
                                @if ($property->is_featured==1)
                                <li><a href="javascript:;"><i class="fas fa-check-circle"></i>{{ $websiteLang->where('lang_key','featured')->first()->custom_text }}</a></li>
                                @endif
                                <li><a href="javascript:;"><i class="far fa-eye"></i> {{ $property->views }}</a></li>
                                <li><a href="#addReviewSection"><i class="fal fa-comment-alt-dots"></i> {{ $websiteLang->where('lang_key','add_review')->first()->custom_text }}</a></li>
                                <li><a href="{{ route('user.add.to.wishlist',$property->id) }}"><i class="fas fa-heart"></i> {{ $websiteLang->where('lang_key','add_wishlist')->first()->custom_text }}</a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="wsus__single_details details_future">
                            <h5>{{ $websiteLang->where('lang_key','detail_and_feature')->first()->custom_text }}</h5>
                            <div class="details_futurr_single">
                                <div class="row">
                                <div class="col-xl-6">
                                    <table class="table">
                                    <tbody>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','property_type_s')->first()->custom_text }}:</th>
                                        <td>{{ $property->propertyType->type }}</td>
                                        </tr>
                                        <tr>
                                        <th> {{ $websiteLang->where('lang_key','area')->first()->custom_text }}:</th>
                                        <td>{{ $property->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</td>
                                        </tr>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','bedrooms')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_bedroom }}</td>
                                        </tr>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','bathrooms')->first()->custom_text }}:</th>
                                        <td>{{  $property->number_of_bathroom  }}</td>
                                        </tr>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','rooms')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_room }}</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-xl-6">
                                    <table class="table xs_sm_mb">
                                    <tbody>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','units')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_unit }}</td>
                                        </tr>
                                        <tr>
                                        <th> {{ $websiteLang->where('lang_key','floors')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_floor }}</td>
                                        </tr>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','kitchens')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_kitchen }}</td>
                                        </tr>
                                        <tr>
                                        <th>{{ $websiteLang->where('lang_key','parking_place_s')->first()->custom_text }}:</th>
                                        <td>{{ $property->number_of_parking }}</td>
                                        </tr>

                                    </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="wsus__single_details details_description">
                            <h5>{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</h5>
                            {!! clean($property->description) !!}

                                @if ($property->file)
                                    <a href="{{ route('download-listing-file',$property->file) }}" class="common_btn mt_20">{{ $websiteLang->where('lang_key','download_pdf')->first()->custom_text }}</a>
                                @endif


                            </div>
                        </div>
                        @if ($property->video_link)
                            @php
                                $video_id=explode("=",$property->video_link);
                            @endphp
                        <div class="col-12">
                            <div class="wsus__single_details details_videos pb_10">
                            <h5>{{ $websiteLang->where('lang_key','property_video')->first()->custom_text }}</h5>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video_id[1] }}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        @endif

                        @if ($property->propertyAminities->count() !=0)
                        <div class="col-12">
                            <div class="wsus__single_details details_aminities pb_10">
                            <h5>{{ $websiteLang->where('lang_key','aminities')->first()->custom_text }}</h5>
                            <ul class="d-flex flex-wrap">
                                @foreach ($property->propertyAminities as $aminity_item)
                                <li><i class="fal fa-check"></i> {{ $aminity_item->aminity->aminity }}</li>
                                @endforeach

                            </ul>
                            </div>
                        </div>
                        @endif

                        @if ($property->propertyNearestLocations->count() !=0)
                            <div class="col-12">
                                <div class="wsus__single_details details_nearest_location pb_10">
                                <h5>{{ $websiteLang->where('lang_key','nearest_place')->first()->custom_text }}</h5>
                                <ul class="d-flex flex-wrap">
                                    @foreach ($property->propertyNearestLocations as $item)
                                    <li><span>{{ $item->nearestLocation->location }}:</span>  {{ $item->distance }}{{ $websiteLang->where('lang_key','km')->first()->custom_text }}</li>
                                    @endforeach
                                </ul>
                                </div>
                            </div>
                        @endif

                        @if ($property->google_map_embed_code)
                            <div class="col-12">
                                <div class="wsus__single_details details_map">
                                    {!! $property->google_map_embed_code !!}
                                </div>
                            </div>
                        @endif

                        @php
                            $total_review=$property->reviews->where('status',1)->count();
                            if($total_review>0){
                                $avg_sum=$property->reviews->where('status',1)->sum('avarage_rating');

                                $service_sum=$property->reviews->where('status',1)->sum('service_rating');
                                $service_avg=$service_sum/$total_review;
                                $service_progress= ($service_avg*100)/5;

                                $location_sum=$property->reviews->where('status',1)->sum('location_rating');
                                $location_avg=$location_sum/$total_review;
                                $location_progress= ($location_avg*100)/5;

                                $money_sum=$property->reviews->where('status',1)->sum('money_rating');
                                $money_avg=$money_sum/$total_review;
                                $money_progress= ($money_avg*100)/5;


                                $clean_sum=$property->reviews->where('status',1)->sum('clean_rating');
                                $clean_avg=$clean_sum/$total_review;
                                $clean_progress= ($clean_avg*100)/5;



                                $avg=$avg_sum/$total_review;
                                $intAvg=intval($avg);
                                $nextVal=$intAvg+1;
                                $reviewPoint=$intAvg;
                                $halfReview=false;
                                if($intAvg < $avg && $avg < $nextVal){
                                    $reviewPoint= $intAvg + 0.5;
                                    $halfReview=true;
                                }

                            }
                        @endphp

                        @if ($total_review >0 )
                        <div class="col-12">
                            <div class="wsus__total_review wsus__single_details">
                                <h5>{{ $total_review }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }}</h5>
                                @foreach ($propertyReviews as $review_item)
                                    <div class="wsus__single_comment">
                                        <div class="wsus__comm_img">
                                            <img src="{{ $review_item->user->image ? url($review_item->user->image) : url($default_image->image) }}" alt="comment img" class="img-fluid img-thumbnail">
                                        </div>
                                        <div class="wsus__comm_text">
                                            @php
                                                $avg=$review_item->avarage_rating;
                                                $intAvg=intval($avg);
                                                $nextVal=$intAvg+1;
                                                $reviewPoint=$intAvg;
                                                $halfReview=false;
                                                if($intAvg < $avg && $avg < $nextVal){
                                                    $reviewPoint= $intAvg + 0.5;
                                                    $halfReview=true;
                                                }
                                            @endphp

                                            <p class="wsus__rev_star">
                                                @for ($i = 1; $i <=5; $i++)
                                                    @if ($i <= $reviewPoint)
                                                        <i class="fas fa-star"></i>
                                                    @elseif ($i> $reviewPoint )
                                                        @if ($halfReview==true)
                                                        <i class="fas fa-star-half-alt"></i>
                                                            @php
                                                                $halfReview=false
                                                            @endphp
                                                        @else
                                                        <i class="fal fa-star"></i>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </p>

                                            <h4>{{ $review_item->user->name }}</h4>
                                            <span>{{ $review_item->created_at->format('d M Y') }}</span>
                                            <p>{{ $review_item->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $propertyReviews->links('user.paginator') }}
                            </div>
                        </div>
                        @endif
                        <div class="col-12" id="addReviewSection">
                            <div class="wsus__single_details details_review">
                            <h5>{{ $websiteLang->where('lang_key','write_review')->first()->custom_text }}</h5>
                            <form action="{{ route('user.store-review') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-7 col-md-6 col-lg-12">
                                        <div class="wsus__select_review">
                                            <ul>
                                            <li><span>{{ $websiteLang->where('lang_key','service')->first()->custom_text }} :</span>
                                                <i class="service_rat fas fa-star" data-service_rating="1" onclick="serviceReview(1)"></i>
                                                <i class="service_rat fas fa-star" data-service_rating="2" onclick="serviceReview(2)"></i>
                                                <i class="service_rat fas fa-star" data-service_rating="3" onclick="serviceReview(3)"></i>
                                                <i class="service_rat fas fa-star" data-service_rating="4" onclick="serviceReview(4)"></i>
                                                <i class="service_rat fas fa-star" data-service_rating="5" onclick="serviceReview(5)"></i>
                                            </li>
                                            <li><span>{{ $websiteLang->where('lang_key','location')->first()->custom_text }} :</span>
                                                <i class="location_rat fas fa-star" data-location_rating="1" onclick="locationReview(1)"></i>
                                                <i class="location_rat fas fa-star" data-location_rating="2" onclick="locationReview(2)"></i>
                                                <i class="location_rat fas fa-star" data-location_rating="3" onclick="locationReview(3)"></i>
                                                <i class="location_rat fas fa-star" data-location_rating="4" onclick="locationReview(4)"></i>
                                                <i class="location_rat fas fa-star" data-location_rating="5" onclick="locationReview(5)"></i>
                                            </li>
                                            <li><span>{{ $websiteLang->where('lang_key','value_for_money')->first()->custom_text }} :</span>
                                                <i class="money_rat fas fa-star" data-money_rating="1" onclick="moneyReview(1)"></i>
                                                <i class="money_rat fas fa-star" data-money_rating="2" onclick="moneyReview(2)"></i>
                                                <i class="money_rat fas fa-star" data-money_rating="3" onclick="moneyReview(3)"></i>
                                                <i class="money_rat fas fa-star" data-money_rating="4" onclick="moneyReview(4)"></i>
                                                <i class="money_rat fas fa-star" data-money_rating="5" onclick="moneyReview(5)"></i>
                                            </li>
                                            <li><span>{{ $websiteLang->where('lang_key','clean_rat')->first()->custom_text }}  :</span>
                                                <i class="clean_rat fas fa-star" data-clean_rating="1" onclick="cleanReview(1)"></i>
                                                <i class="clean_rat fas fa-star" data-clean_rating="2" onclick="cleanReview(2)"></i>
                                                <i class="clean_rat fas fa-star" data-clean_rating="3" onclick="cleanReview(3)"></i>
                                                <i class="clean_rat fas fa-star" data-clean_rating="4" onclick="cleanReview(4)"></i>
                                                <i class="clean_rat fas fa-star" data-clean_rating="5" onclick="cleanReview(5)"></i>
                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-md-6 col-lg-12">
                                        <div class="wsus__total_rating">
                                            <h3 id="avg_rating">5</h3>
                                            <span>{{ $websiteLang->where('lang_key','out_of_5')->first()->custom_text }}</span>
                                            <p>{{ $websiteLang->where('lang_key','avg_rat')->first()->custom_text }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <textarea cols="3" rows="5" placeholder="{{ $websiteLang->where('lang_key','comment')->first()->custom_text }}"  name="comment"></textarea>

                                        @if($setting->allow_captcha==1)
                                        <p class="g-recaptcha mb-3 mt-3" data-sitekey="{{ $setting->captcha_key }}"></p>
                                        @endif

                                        <input type="hidden" name="service_rating" id="service_rating" value="5">
                                        <input type="hidden" name="location_rating" id="location_rating" value="5">
                                        <input type="hidden" name="money_rating" id="money_rating" value="5">
                                        <input type="hidden" name="clean_rating" id="clean_rating" value="5">
                                        <input type="hidden" name="avarage_rating" id="avarage_rating" value="5">
                                        <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">

                                        @auth
                                            @php
                                                $activeUser=Auth::guard('web')->user();
                                            @endphp
                                            @if ($activeUser->id !=$property->user_id)
                                            <button type="submit" class="common_btn">{{ $websiteLang->where('lang_key','submit')->first()->custom_text }}</button>
                                            @endif
                                        @else
                                            <p class="worning"><a href="{{ route('login') }}" class="text-danger">{{ $websiteLang->where('lang_key','before_review')->first()->custom_text }}</a></p>
                                        @endauth

                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="wsus__property_sidebar" id="sticky_sidebar">
            <div class="wsus__sidebar_message">
                @if ($property->user_type==1)
                    <div class="wsus__sidebar_message_top">
                        <img src="{{ $property->admin->image ? url($property->admin->image) :  url($default_image->image) }}" alt="images" class="img-fluid img-thumbnail">
                        <a class="name" href="{{ route('agent.show',['user_type' => '1','user_name'=>$property->admin->slug]) }}">{{ $property->admin->name }}</a>
                        <a class="mail" href="mailto:{{ $property->admin->email }}"><i class="fal fa-envelope-open"></i> {{ $property->admin->email }}</a>
                    </div>
                @else
                    <div class="wsus__sidebar_message_top">
                        <img src="{{ $property->user->image ? url($property->user->image) : url($default_image->image) }}" alt="images" class="img-fluid img-thumbnail">
                        <a class="name" href="{{ route('agent.show',['user_type' => '2','user_name'=>$property->user->slug]) }}">{{ $property->user->name }}</a>
                        <a class="mail" href="mailto:{{ $property->user->email }}"><i class="fal fa-envelope-open"></i> {{ $property->user->email }}</a>
                    </div>
                @endif
                <form id="listingAuthContactForm">
                    @csrf
                    <div class="wsus__sidebar_input">
                        <label>{{ $websiteLang->where('lang_key','name')->first()->custom_text }}</label>
                        <input type="text" name="name">
                    </div>
                    <div class="wsus__sidebar_input">
                        <label>{{ $websiteLang->where('lang_key','email')->first()->custom_text }}</label>
                        <input type="email" name="email">
                    </div>
                    <div class="wsus__sidebar_input">
                        <label>{{ $websiteLang->where('lang_key','phone')->first()->custom_text }}</label>
                        <input type="text" name="phone">
                    </div>
                    <div class="wsus__sidebar_input">
                        <label>{{ $websiteLang->where('lang_key','subject')->first()->custom_text }}</label>
                        <input type="text" name="subject">
                    </div>
                    <div class="wsus__sidebar_input">
                        <label>{{ $websiteLang->where('lang_key','des')->first()->custom_text }}</label>
                        <textarea cols="3" rows="3" name="message"></textarea>
                        <input type="hidden" name="user_type" value="{{ $property->user_type }}">
                        @if ($property->user_type==1)
                        <input type="hidden" name="admin_id" value="{{ $property->admin_id }}">
                        @else
                        <input type="hidden" name="user_id" value="{{ $property->user_id }}">
                        @endif


                        @if($setting->allow_captcha==1)
                        <p class="g-recaptcha mt-3" data-sitekey="{{ $setting->captcha_key }}"></p>
                        @endif

                    <button type="submit" id="listingAuthorContctBtn" class="common_btn"><i id="listcontact-spinner" class="loading-icon fa fa-spin fa-spinner d-none mr-5"></i> {{ $websiteLang->where('lang_key','send_msg')->first()->custom_text }}</button>
                    </div>

                </form>
            </div>

            @php
                $isActivePropertyQty=0;
                foreach ($similarProperties as $value) {
                    if($value->expired_date==null){
                        $isActivePropertyQty +=1;
                    }else if($value->expired_date >= date('Y-m-d')){
                        $isActivePropertyQty +=1;
                    }
                }
            @endphp

            @if ($isActivePropertyQty !=0)
            <div class="row">
                @foreach ($similarProperties as $similar_item)
                    @if ($similar_item->expired_date==null)
                        <div class="col-xl-12 col-md-6 col-lg-12">
                            <div class="wsus__single_property">
                            <div class="wsus__single_property_img">
                                <img src="{{ asset($similar_item->thumbnail_image) }}" alt="properties" class="img-fluid w-100">

                                @if ($similar_item->property_purpose_id==1)
                                <span class="sale">{{ $similar_item->propertyPurpose->custom_purpose }}</span>

                                @elseif($similar_item->property_purpose_id==2)
                                <span class="sale">{{ $similar_item->propertyPurpose->custom_purpose }}</span>
                                @endif

                                @if ($similar_item->urgent_property==1)
                                    <span class="rent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                @endif

                            </div>
                            <div class="wsus__single_property_text">
                                @if ($similar_item->property_purpose_id==1)
                                    <span class="tk">{{ $currency->currency_icon }}{{ $similar_item->price }}</span>
                                @elseif ($similar_item->property_purpose_id==2)
                                <span class="tk">{{ $currency->currency_icon }}{{ $similar_item->price }} /
                                    @if ($similar_item->period=='Daily')
                                    <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                                    @elseif ($similar_item->period=='Monthly')
                                    <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                                    @elseif ($similar_item->period=='Yearly')
                                    <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                                    @endif
                                </span>
                                @endif

                                <a href="{{ route('property.details',$similar_item->slug) }}" class="title w-100">{{ $similar_item->title }}</a>
                                <ul class="d-flex flex-wrap justify-content-between">
                                    <li><i class="fal fa-bed"></i> {{ $similar_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                    <li><i class="fal fa-shower"></i> {{ $similar_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                    <li><i class="fal fa-draw-square"></i> {{ $similar_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                </ul>
                                <div class="wsus__single_property_footer d-flex justify-content-between align-items-center">
                                    <a href="{{ route('search-property',['page_type' => 'list_view','property_type' => $similar_item->propertyType->id]) }}" class="category">{{ $similar_item->propertyType->type }}</a>

                                @php
                                    $total_review=$similar_item->reviews->where('status',1)->count();
                                    if($total_review > 0){
                                        $avg_sum=$similar_item->reviews->where('status',1)->sum('avarage_rating');

                                        $avg=$avg_sum/$total_review;
                                        $intAvg=intval($avg);
                                        $nextVal=$intAvg+1;
                                        $reviewPoint=$intAvg;
                                        $halfReview=false;
                                        if($intAvg < $avg && $avg < $nextVal){
                                            $reviewPoint= $intAvg + 0.5;
                                            $halfReview=true;
                                        }
                                    }
                                @endphp

                                @if ($total_review > 0)
                                    <span class="rating">{{ sprintf("%.1f", $reviewPoint) }}

                                    @for ($i = 1; $i <=5; $i++)
                                        @if ($i <= $reviewPoint)
                                            <i class="fas fa-star"></i>
                                        @elseif ($i> $reviewPoint )
                                            @if ($halfReview==true)
                                            <i class="fas fa-star-half-alt"></i>
                                                @php
                                                    $halfReview=false
                                                @endphp
                                            @else
                                            <i class="fal fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                    </span>
                                @else
                                    <span class="rating">0.0
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fal fa-star"></i>
                                        @endfor
                                    </span>
                                @endif
                                </div>
                            </div>
                            </div>
                        </div>
                    @elseif($similar_item->expired_date >= date('Y-m-d'))
                        <div class="col-xl-12 col-md-6 col-lg-12">
                            <div class="wsus__single_property">
                            <div class="wsus__single_property_img">
                                <img src="{{ asset($similar_item->thumbnail_image) }}" alt="properties" class="img-fluid w-100">

                                @if ($similar_item->property_purpose_id==1)
                                <span class="sale">{{ $similar_item->propertyPurpose->custom_purpose }}</span>

                                @elseif($similar_item->property_purpose_id==2)
                                <span class="sale">{{ $similar_item->propertyPurpose->custom_purpose }}</span>
                                @endif

                                @if ($similar_item->urgent_property==1)
                                    <span class="rent">{{ $websiteLang->where('lang_key','urgent')->first()->custom_text }}</span>
                                @endif

                            </div>
                            <div class="wsus__single_property_text">
                                @if ($similar_item->property_purpose_id==1)
                                    <span class="tk">{{ $currency->currency_icon }}{{ $similar_item->price }}</span>
                                @elseif ($similar_item->property_purpose_id==2)
                                <span class="tk">{{ $currency->currency_icon }}{{ $similar_item->price }} /
                                    @if ($similar_item->period=='Daily')
                                    <span>{{ $websiteLang->where('lang_key','daily')->first()->custom_text }}</span>
                                    @elseif ($similar_item->period=='Monthly')
                                    <span>{{ $websiteLang->where('lang_key','monthly')->first()->custom_text }}</span>
                                    @elseif ($similar_item->period=='Yearly')
                                    <span>{{ $websiteLang->where('lang_key','yearly')->first()->custom_text }}</span>
                                    @endif
                                </span>
                                @endif

                                <a href="{{ route('property.details',$similar_item->slug) }}" class="title w-100">{{ $similar_item->title }}</a>
                                <ul class="d-flex flex-wrap justify-content-between">
                                    <li><i class="fal fa-bed"></i> {{ $similar_item->number_of_bedroom }} {{ $websiteLang->where('lang_key','bed')->first()->custom_text }}</li>
                                    <li><i class="fal fa-shower"></i> {{ $similar_item->number_of_bathroom }} {{ $websiteLang->where('lang_key','bath')->first()->custom_text }}</li>
                                    <li><i class="fal fa-draw-square"></i> {{ $similar_item->area }} {{ $websiteLang->where('lang_key','sqft_s')->first()->custom_text }}</li>
                                </ul>
                                <div class="wsus__single_property_footer d-flex justify-content-between align-items-center">
                                    <a href="{{ route('search-property',['page_type' => 'list_view','property_type' => $similar_item->propertyType->id]) }}" class="category">{{ $similar_item->propertyType->type }}</a>

                                @php
                                    $total_review=$similar_item->reviews->where('status',1)->count();
                                    if($total_review > 0){
                                        $avg_sum=$similar_item->reviews->where('status',1)->sum('avarage_rating');

                                        $avg=$avg_sum/$total_review;
                                        $intAvg=intval($avg);
                                        $nextVal=$intAvg+1;
                                        $reviewPoint=$intAvg;
                                        $halfReview=false;
                                        if($intAvg < $avg && $avg < $nextVal){
                                            $reviewPoint= $intAvg + 0.5;
                                            $halfReview=true;
                                        }
                                    }
                                @endphp

                                @if ($total_review > 0)
                                    <span class="rating">{{ sprintf("%.1f", $reviewPoint) }}

                                    @for ($i = 1; $i <=5; $i++)
                                        @if ($i <= $reviewPoint)
                                            <i class="fas fa-star"></i>
                                        @elseif ($i> $reviewPoint )
                                            @if ($halfReview==true)
                                            <i class="fas fa-star-half-alt"></i>
                                                @php
                                                    $halfReview=false
                                                @endphp
                                            @else
                                            <i class="fal fa-star"></i>
                                            @endif
                                        @endif
                                    @endfor
                                    </span>
                                @else
                                    <span class="rating">0.0
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fal fa-star"></i>
                                        @endfor
                                    </span>
                                @endif
                                </div>
                            </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=====PROPERTY DETAILD  END=====-->


    <script>
        (function($) {
        "use strict";
        $(document).ready(function () {
            $("#listingAuthorContctBtn").on('click',function(e) {
                e.preventDefault();
                // project demo mode check
                var isDemo="{{ env('PROJECT_MODE') }}"
                var demoNotify="{{ env('NOTIFY_TEXT') }}"
                if(isDemo==0){
                    toastr.error(demoNotify);
                    return;
                }
                // end

                $("#listcontact-spinner").removeClass('d-none')
                $("#listingAuthorContctBtn").addClass('custom-opacity')
                $("#listingAuthorContctBtn").attr('disabled',true);
                $("#listingAuthorContctBtn").removeClass('site-btn-effect')

                $.ajax({
                    url: "{{ route('user.contact.message') }}",
                    type:"post",
                    data:$('#listingAuthContactForm').serialize(),
                    success:function(response){
                        if(response.success){
                            $("#listingAuthContactForm").trigger("reset");
                            toastr.success(response.success)
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }
                        if(response.error){
                            toastr.error(response.error)
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                        }
                    },
                    error:function(response){
                        if(response.responseJSON.errors.name){
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                            toastr.error(response.responseJSON.errors.name[0])

                        }

                        if(response.responseJSON.errors.email){
                            toastr.error(response.responseJSON.errors.email[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')

                        }

                        if(response.responseJSON.errors.phone){
                            toastr.error(response.responseJSON.errors.phone[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.subject){
                            toastr.error(response.responseJSON.errors.subject[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.message){
                            toastr.error(response.responseJSON.errors.message[0])
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }else{
                            toastr.error('Please Complete the recaptcha to submit the form')
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }

                        if(response.responseJSON.errors.g-recaptcha){
                            toastr.error('Please Complete the recaptcha to submit the form')
                            $("#listcontact-spinner").addClass('d-none')
                            $("#listingAuthorContctBtn").removeClass('custom-opacity')
                            $("#listingAuthorContctBtn").attr('disabled',false);
                            $("#listingAuthorContctBtn").addClass('site-btn-effect')
                        }


                    }

                });


            })
        });

        })(jQuery);


        function serviceReview(rating){

            $("#service_rating").val(rating);
            $(".service_rat").each(function(){
                var service_rat=$(this).data('service_rating')
                if(service_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }
            })

            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)
        }

        function locationReview(rating){

            $("#location_rating").val(rating);
            $(".location_rat").each(function(){
                var location_rat=$(this).data('location_rating')
                if(location_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })


            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)

        }

        function moneyReview(rating){
            $("#money_rating").val(rating);
            $(".money_rat").each(function(){
                var money_rat=$(this).data('money_rating')
                if(money_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })

            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)

        }

        function cleanReview(rating){

            $("#clean_rating").val(rating);
            $(".clean_rat").each(function(){
                var clean_rat=$(this).data('clean_rating')
                if(clean_rat > rating){
                    $(this).removeClass('fas fa-star').addClass('fal fa-star');
                }else{
                    $(this).removeClass('fal fa-star').addClass('fas fa-star');
                }

            })
            var service_rating=$("#service_rating").val();
            var location_rating=$("#location_rating").val();
            var money_rating=$("#money_rating").val();
            var clean_rating=$("#clean_rating").val();
            var avg= (service_rating * 1) + (location_rating*1) + (money_rating*1) + (clean_rating*1);
            avg= avg/4;
            $("#avarage_rating").val(avg);
            $("#avg_rating").text(avg)
        }




    </script>
@endsection
