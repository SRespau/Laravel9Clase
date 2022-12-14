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
}
