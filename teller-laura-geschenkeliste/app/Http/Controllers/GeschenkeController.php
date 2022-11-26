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
        $geschenke = Geschenkeliste::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('home', compact('geschenke'));
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
        ]);

        $geschenke = new Geschenkeliste;
        $geschenke->geschenk = $request->input('geschenk');
        $geschenke->beschreibung = $request->input('beschreibung');

        //if($request->has('completed')){
        //    $geschenke->besorgt = true;
        //}else{
        //    $geschenke->besorgt = false;
        //}

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
        $geschenke = Geschenkeliste::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(!$geschenke){
            abort(404);
        }
        return view('delete_geschenke', compact('geschenke'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $geschenke = Geschenkeliste::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if(!$geschenke){
            abort(404);
        }
        return view('edit_geschenke', compact('geschenke')); 
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
        $this->validate($request, [
            'geschenk' => 'required|string|max:100', //ein Geschenktitel muss angegeben werden und darf höchstens 100 Zeichen besitzen
            'beschreibung' => 'nullable|string', //eine Beschreibung ist optional und hat keine maximale Zeichenlänge
        ]);

        $geschenke = Geschenkeliste::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $geschenke->geschenk = $request->input('geschenk');
        $geschenke->beschreibung = $request->input('beschreibung');

        $geschenke->save();

        return back()->with('success', 'Geschenk wurde geupdated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $geschenke = Geschenkeliste::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $geschenke->delete();
        return redirect()->route('geschenke.index')->with('success', 'Geschenk erfolgreich gelöscht');
    }
}
