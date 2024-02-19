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
                    <h4>{{ $menus->where('id',17)->first()->navbar }}</h4>
                    <nav style="--bs-breadcrumb-divider: '-';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ $menus->where('id',1)->first()->navbar }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $menus->where('id',17)->first()->navbar }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--===BREADCRUMB PART END====-->


<!--=========FAQ START============-->
<section class="wsus__faq mt_45 mb_45">
  <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="wsus__faq_accordian">
                <div id="wsus__accordian">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($faqs as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne-{{ $item->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne-{{ $item->id }}" aria-expanded="false" aria-controls="flush-collapseOne-{{ $item->id }}">
                                    {{ $item->question }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne-{{ $item->id }}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>{{ $item->answer }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--=========FAQ END==========-->

@endsection
