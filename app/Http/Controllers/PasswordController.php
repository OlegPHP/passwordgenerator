<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index(){

        return view('password.form', ['password' => session('password')]);
    }

    public function generate(Request $request){

        $validated = $request->validate([
            'quantity' => 'required|integer|min:4|max:40',
            'complexity' => 'required|in:1,2',
            'special' => 'required|in:1,2',
        ]);

        $quantity = $validated['quantity'];
        $complexity = $validated['complexity'];
        $special = $validated['special'];

        if($complexity == 1 and $special == 1){// прост, спец
            $password = Str::password($quantity,numbers: false);
        } elseif($complexity == 1 and $special == 2){
            $password = Str::password($quantity,numbers: false, symbols: false);
        } elseif($complexity == 2 and $special == 1){//слож спец
            $password =  Str::password($quantity);
        } elseif($complexity == 2 and $special == 2){
            $password = Str::password($quantity, symbols: false);
        }

        return redirect()
            ->route('index')
            ->withInput()
            ->with('password', $password);
    }


}
