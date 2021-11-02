<?php

namespace App\Http\Controllers;

use App\Rules\INN;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResponseController extends Controller
{
    protected $validation_error_messages = [
        'date.*' => 'Неккоректная дата',
    ];

    protected $api_endpoint = 'https://statusnpd.nalog.ru/api/v1/tracker/taxpayer_status';

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
        ], $this->validation_error_messages);

        $entry = Response::firstOrNew([
            'inn' => $request->inn,
            'check_date' => $request->date,
        ]);

        if ($entry->exists) {
            return redirect()
                ->route('home')
                ->with('message', $entry->data['message']);
        } else {
            $response = Http::timeout(60)->post($this->api_endpoint, [
                'inn' => $request->inn,
                'requestDate' => $request->date,
            ]);

            $entry->data = json_decode($response->getBody()->getContents());
            $entry->save();

            if ($response->failed()) {
                return redirect()
                    ->route('home')
                    ->with('denied', $response['message'])
                    ->withInput();
            }

            return redirect()
                ->route('home')
                ->with('message', $response['message'])
                ->withInput();
        }
    }
}
