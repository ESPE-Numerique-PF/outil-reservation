@extends('layouts.app')

@section('content')
<div class="container mb-3">

    <div class="row">
        <h1>Test</h1>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row">Environnement</th>
                    <td>{{ env('APP_ENV') }}</td>
                </tr>
                <tr>
                    <th scope="row">URL</th>
                    <td>{{ env('APP_URL') }}</td>
                </tr>
                <tr>
                    <th scope="row">Debug mode</th>
                    <td>{{ env('APP_DEBUG') ? 'True' : 'False'}}</td>
                </tr>
                <tr>
                    <th scope="row">PHP version</th>
                    <td>{{ phpversion() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<admin-test-component></admin-test-component>
@endsection