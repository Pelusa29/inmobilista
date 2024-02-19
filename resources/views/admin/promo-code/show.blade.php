@extends('layouts.admin.layout')

@section('title')
    <title>Código de promoción</title>
@endsection

@section('admin-content')
    <h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.promotional-code.index') }}" class="btn btn-success"><i class="fas fa-backward" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','go_back')->first()->custom_text }} </a></h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Código de promoción</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">

                    <tr>
                       <td width="40%">Código</td>
                       <td>{{ $promotionalCode->promotional_code }}</td>
                    </tr>
                    <tr>
                        <td>Plan</td>
                        <td>{{ $promotionalCode->package->package_name }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            @if ( $promotionalCode->is_used )
                                <span class="badge badge-danger">Usado</span>
                            @else
                                <span class="badge badge-success">Disponible</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td>{{ !is_null($promotionalCode->user) ? $promotionalCode->user->name : "Sin usuario" }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de expiración</td>
                        <td>{{ !is_null($promotionalCode->expiration_date) ? $promotionalCode->expiration_date->toDateString() : "Sin fecha" }}</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
@endsection
