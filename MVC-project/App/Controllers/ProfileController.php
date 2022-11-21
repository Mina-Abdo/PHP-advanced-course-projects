<?php
namespace App\Controllers;

class ProfileController{
    public function index(){
        // echo "profile";

        return view('dashboard.index' , ['name'=>'Mina']);
    }

    
}