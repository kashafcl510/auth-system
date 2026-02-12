<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function siteDashboard (){
        return view('site.dashboard');
    }



    public function adminDashboard (){
        return view('admin.dashboard');
    }



    public function forgetPassword(){
        return view('authVelzon.forgetPassword');
    }




    public function resetPassword(){
        return view('authVelzon.resetPassword');
    }



    public function table(){
        return view('site.velzonTable');


    } public function listingPage(){
        return view('site.listings');
    }

     public function categoryPage(){
        return view('admin.categories');
    }
}
