<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imagenes=Imagen::all();
        return view('welcome',array(
            'imagenes'=>$imagenes
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagenes=new Imagen();
        $imagenes->descripcion=$request->input('descripcion');
        $imagenes->precio=$request->input('precio');
        $imagenes->categoria=$request->input('categoria');
        $foto=$request->file('foto');
        if($foto){
            $image_path=$foto->getClientOriginalName();
            Storage::disk('s3')->put($image_path,\File::get($foto));
            $imagenes->foto=$image_path;
        }
        //dd($imagenes);
        $imagenes->save();
        return redirect()->route('welcome');
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
        //
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
        $imagenes=new Imagen();
        $imagenes=Imagen::findOrFail($id);
        $imagenes->descripcion=$request->input('descripcion');
        $imagenes->precio=$request->input('precio');
        $imagenes->categoria=$request->input('categoria');
        $foto=$request->file('foto');
        if($foto){
            $image_path=$foto->getClientOriginalName();
            Storage::disk('s3')->put($image_path,\File::get($foto));
            $imagenes->foto=$image_path;
        }
        $imagenes->update();
        return redirect()->route('welcome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagenes=Imagen::find($id);
        Storage::disk('s3')->delete($imagenes->foto);
        $imagenes->delete($id);
        return redirect()->route('welcome');
    }
}
