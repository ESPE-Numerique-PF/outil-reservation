@extends('layouts.app')

@section('content')
<admin-material-management-component user-id="{{ Auth::user()->id }}"></admin-material-management-component>
@endsection