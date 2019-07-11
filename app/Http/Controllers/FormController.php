<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use File;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::all()->toArray();
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Code
        $this->validate($request, [
            'coinname' => 'required',
            'coinprice' => 'required',
            'radio' => 'required',
            'option' => 'required',
            'coinimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        // Image upload code
        $image = $request->file('coinimage');
        $input['coinimage'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['coinimage']);

        // insert data code
        $form = new Form();
        $form->coinname=$request->get('coinname');
        $form->coinprice=$request->get('coinprice');
        $checkbox = implode("," , $request->get('option'));
        $form->dropdown=$request->get('dropdown');
        $form->radio=$request->get('radio');
        $form->checkbox=$checkbox;
        $form->coinimage=$input['coinimage'];
        $form->save();
        return redirect('forms')->with('success', 'Coin has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::find($id);
        return view('forms.edit', compact('form','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'coinname' => 'required',
            'coinprice'=> 'required|numeric',
            'coinimage'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]); 
        
        if($request->coinimage == '')
        {
            $coinimage = $request->get('oldimage');
        }
        else
        {
            $image = $request->file('coinimage');
            $coinimage = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $coinimage);
            if($request->get('oldimage') != 'images.png'){
                File::delete('images/'.$request->get('oldimage'));
            }
        }

          $form = Form::find($id);
          $form->coinname=$request->get('coinname');
          $form->coinprice=$request->get('coinprice');
          $checkbox = implode(",", $request->get('option'));
          $form->dropdown=$request->get('dropdown');
          $form->radio=$request->get('radio');
          $form->checkbox = $checkbox; 
          $form->coinimage = $coinimage;
          $form->save();
          return redirect('forms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Form::where('id', $id)->first()->coinimage;
        $image;
        $form = Form::find($id);
        $form->delete();
        if( $image != 'images.png'){
            File::delete('images/'. $image);
        }
        return redirect('forms')->with('success','Coin has been  deleted');
    }
}
