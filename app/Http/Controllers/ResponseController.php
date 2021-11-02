<?php

namespace App\Http\Controllers;

use App\Rules\INN;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    protected $error_messages = [
        'date.*' => 'Неккоректная дата',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Check inn
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $validated = $request->validate([
            'inn'   => ['required', new INN],
            'date'  => ['required', 'date'],
        ] , $this->error_messages);

        dd($validated);
    }
}
