<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfireController extends Controller
{
    //


public function add()
{
    return view ("adminp.rofire.create");
}

public function create()
{
    return redirect ("admin/profire/create");

}

public function edit()
{
    return view ("admin.profire.create");
}

public function update()
{
    return redirect ("admin/profire/create");
}

}