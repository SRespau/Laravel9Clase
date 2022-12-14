<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyController extends Controller{
    
    public function index()
    {
        echo "Estamos en index de estudios";
    }

    public function show($id)
    {
        echo "En show de estudio: $id";
    }

    public function create()
    {
        echo "Este es el create de Studies";
    }

    public function edit($id)
    {
        echo "Este es el edit de estudies para modificar la id $id";
    }

    public function destroy($id)
    {
        echo "Este es el destroy de $id";
    }

    public function update($id)
    {
        echo "Este es el update de estudies para modificar la id $id";
    }

    public function store()
    {
        echo "Este es el store de estudies";
    }
}
