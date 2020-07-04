<?php

namespace App\Http\Controllers;

use App\ajaxImage;
use Illuminate\Http\Request;
use Validator;

class AjaxImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajaxImage');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $validator = Validator::make($request->all(), [
          'ajax_images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
          $input = $request->all();
          $input['ajax_images'] = time().'.'.$request->ajax_images->getClientOriginalExtension();
          $request->ajax_images->move(public_path('ajax_images'), $input['ajax_images']);
          AjaxImage::create($input);
          return response()->json(['status' => true,'msg'=> 'Successfully file uploaded by ajax code']);
        }else{
           return response()->json(['status' => false,'msg'=>$validator->errors()->all()]);
        }
      } catch (\Exception $e) {
        return response()->json(['status' => false,'msg'=> $e->getMessage()]);
      }
    }
}
