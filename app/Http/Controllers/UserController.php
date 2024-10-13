<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('role:user|administrator');
    }

    function index(){
        $robots = \App\robot::all();
        $images = \App\image::all();
        $osie = \App\osie::all();
        $producent = \App\producent::all();
        $przeznaczenie = \App\przeznaczenie::all();
        $stanowisko = \App\stanowisko::all();
        return view('user.user', compact('robots', 'images', 'osie', 'producent', 'przeznaczenie', 'stanowisko'));
    }
}















