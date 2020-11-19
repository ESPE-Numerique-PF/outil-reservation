@extends('layouts.app')

@section('content')
<div class="container py-3">

    <div class="row">
        <h1>Info</h1>
    </div>
    <div class="row">
        <table id="server-info-table" class="table table-bordered">
            <tbody>
                @foreach ($info as $key => $value)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection