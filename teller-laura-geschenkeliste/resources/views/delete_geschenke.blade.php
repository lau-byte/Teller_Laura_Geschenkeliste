@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $geschenke->geschenk }} löschen</div>

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

                <form method="POST" action="{{ route('geschenke.destroy', $geschenke->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <h4 class="text-center">
                                    Soll {{ $geschenke->delete }} wirklich gelöscht werden?
                                </h4>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Ja
                                </button>
                                <a href="{{ route('geschenke.index') }}" class="btn btn-info">Nein</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection