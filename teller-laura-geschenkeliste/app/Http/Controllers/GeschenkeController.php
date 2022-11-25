<?php

namespace App\Http\Controllers;

use App\Models\Geschenkeliste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeschenkeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_geschenke');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'geschenk' => 'required|string|max:100', //ein Geschenktitel muss angegeben werden und darf höchstens 100 Zeichen besitzen
            'beschreibung' => 'nullable|string', //eine Beschreibung ist optional und hat keine maximale Zeichenlänge
            'besorgt' => 'nullable', //Die Auswahl "besorgt" ist optional
        ]);

        $geschenke = new Geschenkeliste;
        $geschenke->geschenk = $request->input('geschenk');
        $geschenke->beschreibung = $request->input('beschreibung');

        if($request->has('besorgt')){
            $geschenke->besorgt = true;
        }

        $geschenke->user_id = Auth::user()->id;

        $geschenke->save();

        return back()->with('success', 'Geschenk wurde hinzugefügt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
