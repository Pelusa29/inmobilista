<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\PromotionalCode;
use App\ManageText;
use App\Package;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websiteLang      = ManageText::all();
        $promotionalCodes = PromotionalCode::all();

        return view('admin.promo-code.index', compact('promotionalCodes', 'websiteLang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $websiteLang = ManageText::all();
        $packages    = Package::where('status', 1)->get();

        return view('admin.promo-code.create', compact('packages', 'websiteLang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar
        $request->validate([
            'promotional_code' => 'required|unique:promotional_codes,promotional_code',
            'package_id'       => 'required|exists:packages,id',
            'expiration_date'  => 'required',
        ], [
            'promotional_code.required'  => 'Es necesario añadir un código de promoción.',
            'promotional_code.unique'    => 'Ese código de promoción ya existe.',
            'package_id.required'        => 'Es necesario añadir un plan.',
            'package_id.unique'          => 'No se encontró el plan.',
            'expiration_date.required'   => 'Es necesario añadir una fecha de expiración.',  
        ]);

        // Procesar
        $promotionalCode = PromotionalCode::create( $request->all() );

        // Salida
        return redirect()->route('admin.promotional-code.show', $promotionalCode->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionalCode $promotionalCode)
    {
        $websiteLang = ManageText::all();

        return view('admin.promo-code.show', compact('promotionalCode', 'websiteLang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotionalCode $promotionalCode)
    {
        $websiteLang = ManageText::all();
        $packages    = Package::where('status', 1)->get();

        return view('admin.promo-code.edit', compact('promotionalCode', 'packages', 'websiteLang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PromotionalCode $promotionalCode)
    {
        // Validar
        $request->validate([
            'promotional_code' => 'required|unique:promotional_codes,promotional_code,'.$promotionalCode->id,
            'package_id'       => 'required|exists:packages,id',
            'expiration_date'  => 'required',
        ], [
            'promotional_code.required'  => 'Es necesario añadir un código de promoción.',
            'promotional_code.unique'    => 'Ese código de promoción ya existe.',
            'package_id.required'        => 'Es necesario añadir un plan.',
            'package_id.unique'          => 'No se encontró el plan.',
            'expiration_date.required'   => 'Es necesario añadir una fecha de expiración.',  
        ]);

        // Procesar
        $promotionalCode->update( $request->all() );

        // Salida
        return redirect()->route('admin.promotional-code.show', $promotionalCode->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
