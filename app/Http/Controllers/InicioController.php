<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacionHome;
use App\UpdatePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InicioController extends Controller
{
    
    public function index(Request $request)
    {
        $inicio=UpdatePage::all();
        return view('inicio',compact('inicio'));  
    }

    public function editarPagina()
    {
        $inicioEditar=UpdatePage::all();
        return view('editar-pagina-inicio',compact('inicioEditar')); 
    }

    public function update(ValidacionHome $request, $id)
    {
        $datoEquipo=request()->except('_token', '_method');

        if($request->hasFile('sliderImage1')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->sliderImage1);
            $datoEquipo['sliderImage1'] = $request->file('sliderImage1')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('sliderImage2')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->sliderImage2);
            $datoEquipo['sliderImage2'] = $request->file('sliderImage2')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('sliderImage3')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->sliderImage3);
            $datoEquipo['sliderImage3'] = $request->file('sliderImage3')->store('uploads/paginaInicio','public');
        }

        /**
         * galeria
         */

        if($request->hasFile('image1')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image1);
            $datoEquipo['image1'] = $request->file('image1')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('image2')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image2);
            $datoEquipo['image2'] = $request->file('image2')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('image3')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image3);
            $datoEquipo['image3'] = $request->file('image3')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('image4')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image4);
            $datoEquipo['image4'] = $request->file('image4')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('image5')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image5);
            $datoEquipo['image5'] = $request->file('image5')->store('uploads/paginaInicio','public');
        }

        if($request->hasFile('image6')){
            $buscarID = UpdatePage::findOrFail($id);
            Storage::delete('public/'.$buscarID->image6);
            $datoEquipo['image6'] = $request->file('image6')->store('uploads/paginaInicio','public');
        }

        UpdatePage::where('id','=',$id)->update($datoEquipo);
        $buscarID = UpdatePage::findOrFail($id);
        return redirect()->route('home')->with('flash-success','Pagina Inicio actualizado exitosamente');
    }
}
