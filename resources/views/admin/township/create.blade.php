@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','township_describe')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.township.index') }}" class="btn btn-primary"><i class="fas fa-list" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','townships')->first()->custom_text }} </a></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Municipio Form</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.township.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label>{{ $websiteLang->where('lang_key','city')->first()->custom_text }}</label>
                    <select name="city_id"  class="form-control" id="custom-select2">
                        <option value="">{{ $websiteLang->where('lang_key','select_city')->first()->custom_text }}</option>
                        @foreach ($cities as $item)
                            <option {{ old('city')==$item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name.', '.$item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">{{ $websiteLang->where('lang_key','township_describe')->first()->custom_text }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="status">{{ $websiteLang->where('lang_key','status')->first()->custom_text }}</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">{{ $websiteLang->where('lang_key','active')->first()->custom_text }}</option>
                        <option value="0">{{ $websiteLang->where('lang_key','inactive')->first()->custom_text }}</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
            </form>
        </div>
    </div>
@endsection
