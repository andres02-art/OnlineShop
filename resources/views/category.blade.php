@extends('layouts.app')

@section('content')
    @role('admin')
    <profile-index user-role="admin">

@endrole
@role('user')
<profile-index user-role="user">
    @endrole
@endsection
