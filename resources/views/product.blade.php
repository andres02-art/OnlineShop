@extends('layouts.app')

@section('content')
    <product-index :product-item-id={{ $Product->id }} :auth-user={{ Auth::user()->id??'false' }}></product-index>
@endsection
