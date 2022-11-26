@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $geschenke->geschenk }} bearbeiten</div>

                <h5 class="card-header">
                    <a href="{{ route('geschenke.index') }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i> Zurück</a>
                </h5>

                <div class="card-body">
                
                <!-- Fehlermeldung Alert -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Erfolg Alert -->
                @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
                        </div>
                @endif

                <form method="POST" action="{{ route('geschenke.update', $geschenke->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="geschenk" class="col-form-label text-md-right">Geschenk</label>

                            <input id="geschenk" type="geschenk" class="form-control @error('geschenk') is-invalid @enderror" name="geschenk" value="{{ $geschenke->geschenk }}" autocomplete="geschenk" autofocus>

                            @error('geschenk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-form-label text-md-right">Beschreibung</label>

                            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('password') is-invalid @enderror" autocomplete="description" value="{{ $geschenke->beschreibung }}"></textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Speichern
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection