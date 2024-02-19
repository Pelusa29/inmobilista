<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Township;
use App\ManageText;
use App\ValidationText;
use App\CountryState;
use Str;
use App\NotificationText;

class TownshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $townships = Township::all();
        $websiteLang = ManageText::all();
        return view('admin.township.index', compact('townships', 'websiteLang'));
    }

    public function create()
    {
        $cities = City::all();
        $websiteLang = ManageText::all();
        return view('admin.township.create', compact('cities', 'websiteLang'));
    }


    public function store(Request $request)
    {

        // project demo mode check
        if (env('PROJECT_MODE') == 0) {
            $notification = array(
                'messege' => env('NOTIFY_TEXT'),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang = ValidationText::all();

        $rules = [
            'status'    => 'required',
            'city_id'   => 'required|integer',
            'name'      => 'required|max:250',
            'name'      => 'required|unique:townships,name,NULL,id,city_id,' . $request->city_id
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.',
            'city_id.integer' => 'The :attribute field is required.',
            'name.max' => 'The :attribute may not be greater than 250 characters.',
            'name.unique' => 'The :attribute has already been taken.'
        ];

        $this->validate($request, $rules, $customMessages);

        $township = new Township();
        $township->city_id = $request->city_id;
        $township->name = $request->name;
        $township->slug = Str::slug($request->name);
        $township->status = $request->status;
        $township->save();

        $notify_lang = NotificationText::all();
        $notification = $notify_lang->where('lang_key', 'create')->first()->custom_text;
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->back()->with($notification);
        //return redirect()->back()->with(['messege' => "ok", 'alert-type' => 'success']);
    }

    public function edit(Township $township)
    {
        //$township_data = Township::find($id);
        $cities = City::all();
        $websiteLang = ManageText::all();

        return view('admin.township.edit', compact('township', 'cities', 'websiteLang'));
    }

    public function update(Request $request, Township $township)
    {
        // project demo mode check
        if (env('PROJECT_MODE') == 0) {
            $notification = array(
                'messege' => env('NOTIFY_TEXT'),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang = ValidationText::all();

        $rules = [
            'status'    => 'required',
            'city_id'   => 'required|integer',
            'name'      => 'required|max:250',
            'name'      => 'required|unique:townships,name,' . $township->id . ',id,city_id,' . $request->city_id
        ];

        $customMessages = [
            'required' => 'The :attribute field is required.',
            'city_id.integer' => 'The :attribute field is required.',
            'name.max' => 'The :attribute may not be greater than 250 characters.',
            'name.unique' => 'The :attribute has already been taken.'
        ];

        $this->validate($request, $rules, $customMessages);

        $township->city_id = $request->city_id;
        $township->name = $request->name;
        $township->slug = Str::slug($request->name);
        $township->status = $request->status;
        $township->save();

        $notify_lang = NotificationText::all();
        $notification = $notify_lang->where('lang_key', 'create')->first()->custom_text;
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->route('admin.township.index')->with($notification);
    }

    public function destroy(Township $township)
    {
        // project demo mode check
        if (env('PROJECT_MODE') == 0) {
            $notification = array(
                'messege' => env('NOTIFY_TEXT'),
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $township->delete();

        $notify_lang = NotificationText::all();
        $notification = $notify_lang->where('lang_key', 'delete')->first()->custom_text;
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function submitPost(Request $request)
    {
        if ($request->ajax()) {
            $township = Township::find($request->id);
            $township->status = $township->status == 1 ? 0 : 1;
            $township->save();

            return response()->json(['success' => true, 'message' => 'Township status updated successfully']);
        }

        return response()->json(["status" => false, 'message' => 'Error updating township status']);
    }

    public function getTownships(Request $request)
    {
        if ($request->ajax()) {
            $city_id = $request->city_id;
            $townships = Township::where('city_id', $city_id)->get();
            $townships_option_select = array();

            if (count($townships) > 0) {
                $townships_option_select[] = '<option value="">' . "Municipios" . '</option>';
                foreach ($townships as $state) {
                    $townships_option_select[] .= '<option value="' . $state->id . '">' . $state->name . '</option>';
                }
            } else {
                $townships_option_select[] = '<option value="">' . "Municipios" . '</option>';
            }

            return response()->json($townships_option_select);
        }
    }
}
