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
        ], [
            'quantity.required' => 'Поле "Количество символов" обязательно для заполнения.',
            'quantity.integer'  => 'Поле "Количество символов" должно быть числом.',
            'quantity.min'      => 'Количество символов должно быть не меньше 4!',
            'quantity.max'      => 'Количество символов не должно превышать 40!',
            'complexity.required' => 'Выберите сложность пароля.',
            'complexity.in'       => 'Выбранная сложность некорректна.',
            'special.required'    => 'Выберите, добавлять ли специальные символы.',
            'special.in'          => 'Выбранное значение для спецсимволов некорректно.',
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
