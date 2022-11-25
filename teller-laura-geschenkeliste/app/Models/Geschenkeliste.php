<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geschenkeliste extends Model
{
    use HasFactory;

//    protected $fillable = [
//      'geschenk',
//      'beschreibung',
//      'besorgt',
//      'user_id',
//  ];
protected $guarded = [];

public function user() //Funktion, um Geschenkliste mit User zu verknüpfen
{
    return $this->belongsTo(User::class);
}

}
