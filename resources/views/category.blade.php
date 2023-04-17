@extends('layouts.app')

@section('content')
    <category-index :auth-user={{ Auth::user()->id??'false' }} :category-default={{ $Category->id }}>
@endsection
