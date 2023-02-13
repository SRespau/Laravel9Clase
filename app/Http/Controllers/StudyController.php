<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study;

class StudyController extends Controller{
    
    public function index()
    {
        $studyList = Study::all();
        return view("study.index", ["studyList"=>$studyList]); 
    }

    public function show($id)
    {
        $studyList = Study::all(); //Eloquent ORM
        return view("study.index", ["studyList"=>$studyList]);
    }

    public function create()
    {        
        return view("study.create");
    }

    public function edit($id)
    {        
        
        $study = Study::find($id);
       
        return view("study.edit", ["study" => $study]);
    }

    public function destroy($id)
    {
        $study = Study::Find($id);
        $study->delete();
        return redirect()->route("studies.index")->with("exito", "Estudio eliminado correctamente"); 

    }


    public function update(Request $request, $id)
    {
        $study = Study::Find($id);
        
        $study->fill($request->all());
        $study->save();
        
        return redirect()->route("studies.index")->with("exito", "Estudio actualizado correctamente");
    }


    public function store(Request $request)
    {        
               
        Study::create($request->all());
        return redirect()->route("study.index")->with("exito", "Estudio añadido correctamente");
    }
}
