@extends('layouts.user.profile.layout')
@section('title')
    <title>{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }}</title>
@endsection


@section('user-dashboard')
<div class="row">
    <div class="col-xl-9 ms-auto">
        <div class="wsus__dashboard_main_content">
          <div class="wsus__my_property">
            <h4 class="heading">{{ $websiteLang->where('lang_key','my_property')->first()->custom_text }} <a href="{{ route('user.create.property') }}" class="common_btn"><i class="fal fa-plus-octagon"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }}</a></h4>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                    <table class="table">
                      <tr>
                          <th class="image">
                            {{ $websiteLang->where('lang_key','img')->first()->custom_text }}
                          </th>
                          <th class="title">
                            {{ $websiteLang->where('lang_key','property')->first()->custom_text }}
                          </th>
                          <th class="purpose">
                            {{ $websiteLang->where('lang_key','purpose')->first()->custom_text }}
                          </th>
                          <th class="status">
                            {{ $websiteLang->where('lang_key','status')->first()->custom_text }}
                          </th>
                          <th class="actions">
                            {{ $websiteLang->where('lang_key','action')->first()->custom_text }}
                          </th>
                      </tr>
                      @foreach ($properties as $item)
                      <tr>
                          <td class="image">
                              <a href="{{ route('property.details',$item->slug) }}">
                                  <img src="{{ url($item->thumbnail_image) }}" alt="img" class="img-fluid w-100">
                              </a>
                          </td>
                          <td class="title">
                              <h5><a href="{{ route('property.details',$item->slug) }}">{{ $item->title }}</a></h5>
                              <p class="address">{{ $item->address.', '.$item->city->name }}</p>

                                @php
                                    $total_review=$item->reviews->where('status',1)->count();
                                    if($total_review > 0){
                                        $avg_sum=$item->reviews->where('status',1)->sum('avarage_rating');


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
                                <p class="rating">
                                    <span>{{ sprintf("%.1f", $reviewPoint) }}</span>
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
                                    <span>({{ $total_review }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }})</span>
                                </p class="rating">
                                @else
                                    <p>
                                        <span>0.0</span>
                                        @for ($i = 1; $i <=5; $i++)
                                        <i class="fal fa-star"></i>
                                        @endfor
                                        <span>({{ 0 }} {{ $websiteLang->where('lang_key','review')->first()->custom_text }})</span>
                                    </p>
                                @endif

                          </td>
                          <td class="purpose">
                              <p>{{ $item->propertyPurpose->custom_purpose }}</p>
                          </td>
                          <td class="status">
                                @if ($item->status==1)
                                    @if ($item->expired_date==null)
                                    <p class="active">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</p>
                                    @elseif($item->expired_date >= date('Y-m-d'))
                                    <p class="active">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</p>
                                    @else
                                    <p >{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</p>
                                    @endif
                                @else
                                <p >{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</p>
                                @endif
                          </td>
                          <td class="actions">
                            <ul class="d-flex">
                              <li><a href="{{ route('property.details',$item->slug) }}"><i class="far fa-eye"></i></a></li>
                              <li><a href="{{ route('user.property.edit',$item->id) }}"><i class="fal fa-edit"></i></a></li>
                              <li><a onclick="deleteProperty('{{ $item->id }}')"><i class="far fa-trash-alt"></i></a></li>
                            </ul>
                          </td>
                      </tr>

                      @endforeach
                  </table>
                </div>
              </div>
              <div class="col-12 mt_25">
                {{ $properties->links('user.paginator') }}
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<script>
    function deleteProperty(id){
        Swal.fire({
            title: "{{ $websiteLang->where('lang_key','are_you_sure')->first()->custom_text }}",
            text: "{{ $websiteLang->where('lang_key','delete_des')->first()->custom_text }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ $websiteLang->where('lang_key','yes_delete')->first()->custom_text }}",
            cancelButtonText: "{{ $websiteLang->where('lang_key','cancel')->first()->custom_text }}",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "{{ $websiteLang->where('lang_key','delete')->first()->custom_text }}",
                    "{{ $websiteLang->where('lang_key','delete_success')->first()->custom_text }}",
                    'success'
                )
                location.href = "{{ url('user/delete-property/') }}" + "/" + id;
            }
        })
    }
</script>
@endsection
