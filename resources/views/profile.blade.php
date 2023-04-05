@extends('layouts.app')

@section('content')
    <profile-index :auth-user={{ Auth::user()->id??'false' }}></profile-index>
@endsection
