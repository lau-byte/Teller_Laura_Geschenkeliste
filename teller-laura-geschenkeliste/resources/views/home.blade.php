@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deine Geschenkeliste') }}</div>

                <h5 class="card-header">
                    <a href="{{ route('geschenke.create') }}" class="btn btn-sm btn-outline-primary">Geschenk hinzufügen</a>
                </h5>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Erfolg Alert -->
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    <table class="table table-hover table-borderless">
                        <thead>
                            <th scope="col">Geschenk</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            @forelse ($geschenke as $geschenk)
                            <tr>

                                    <td><a href="{{ route('geschenke.edit', $geschenk->id) }}" style="color: black">{{ $geschenk->geschenk }}</a></td>

                                <td>
                                    <a href="{{ route('geschenke.edit', $geschenk->id) }}" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil-square-o"></i> Bearbeiten</a>
                                    <a href="{{ route('geschenke.show', $geschenk->id) }}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Löschen</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td style="color:grey">noch keine Geschenke eingtragen</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
