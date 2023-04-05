@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="get" action={{ route('register.create') }}>
                            @csrf

                            <profile-form :response-reject="{{ $errors }}" :user-has-login=false :user-login={{ Auth::user()->id??null }}></profile-form>
                            <div class="row">
                                <div class="col d-flex justify-content-center gap-3 p-3">
                                    <button class="btn btn-primary" type="submit">Registrarse</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
