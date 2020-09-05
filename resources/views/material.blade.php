@extends('layouts.app')

@section('content')
<!-- Vue component (resources/js/components/MaterialListComponent) -->
<material-list-component user="{{ Auth::user() }}"></material-list-component>
@endsection
