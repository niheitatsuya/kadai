<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\profile;

class ProfileController extends Controller
{
    
public function add()
{
    return view ("admin.profile.create");
}

public function create(Request $request)
{
    return redirect ("admin/profile/create");
    
      $profile->fill($form);
      $profile->save();

}

public function edit()
{
    return view ("admin.profile.create");
}

public function update()
{
    return redirect ("admin/profile/create");
}


}