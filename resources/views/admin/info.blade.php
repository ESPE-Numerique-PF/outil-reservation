@extends('layouts.app')

@section('content')
<div class="container mb-3">

    <div class="row">
        <h1>Info</h1>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Environnement</th>
                    <td>{{ config('app.env') }}</td>
                </tr>
                <tr>
                    <th scope="row">URL</th>
                    <td>{{ config('app.url') }}</td>
                </tr>
                <tr>
                    <th scope="row">Debug mode</th>
                    <td>{{ config('app.debug') ? 'True' : 'False'}}</td>
                </tr>
                <tr>
                    <th scope="row">PHP version</th>
                    <td>{{ phpversion() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection