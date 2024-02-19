@extends('layouts.admin.layout')

@section('title')
    <title>Código de promoción</title>
@endsection

@section('admin-content')
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.promotional-code.index') }}" class="btn btn-success"><i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','go_back')->first()->custom_text }} </a></h1>

    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.promotional-code.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4>Crear código promocional</h4>
                        <hr>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="promotional_code">Código de promoción<span class="text-danger">*</span></label>
                                    <input type="text" name="promotional_code" class="form-control" id="promotional_code" value="{{ old('promotional_code') }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="package_id">Plan<span class="text-danger">*</span></label>
                                    <select name="package_id" class="form-control" id="package_id">
                                        <option value=""></option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? "selected" : "" }}>{{ $package->package_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="expiration_date">Fecha de expiración<span class="text-danger">*</span></label>
                                    <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ old('expiration_date') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12" style="text-align:right;">
                                <button class="btn btn-success">{{ $websiteLang->where('lang_key','save')->first()->custom_text }}</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection