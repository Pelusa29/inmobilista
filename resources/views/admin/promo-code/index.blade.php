@extends('layouts.admin.layout')

@section('title')
    <title>Códigos promocionales</title>
@endsection

@section('admin-content')

<h1 class="h3 mb-2 text-gray-800"><a href="{{ route('admin.promotional-code.create') }}" class="btn btn-primary"><i class="fas fa-plus" aria-hidden="true"></i> {{ $websiteLang->where('lang_key','create')->first()->custom_text }}</a></h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Códigos promocionales</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th></th>
                        <th width="10%">Código</th>
                        <th>Plan</th>
                        <th>Usuario</th>
                        <th>Fecha expiración</th>
                        <th>Estado</th>
                        <th width="80px"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($promotionalCodes as $index => $code)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $code->promotional_code }}</td>
                            <td>{{ $code->package->package_name }}</td>
                            <td>{{ !is_null($code->user) ? $code->user->name : "Sin usuario" }}</td>
                            <td>{{ !is_null($code->expiration_date) ? $code->expiration_date->toDateString() : "Sin fecha" }}</td>
                            <td>
                                @if ( $code->is_used )
                                    <span class="badge badge-danger">Usado</span>
                                @else
                                    <span class="badge badge-success">Disponible</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.promotional-code.show',$code->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ route('admin.promotional-code.edit',$code->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection