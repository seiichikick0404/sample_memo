@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="folder-bar col-3"></div>
        <div class="file-bar col-3"></div>
        <div class="main-content col-6"></div>
    </div>
    <button type="button" class="btn btn-primary">Primary</button>
    <button type="button" class="btn btn-secondary">Secondary</button>
    <button type="button" class="btn btn-success">Success</button>
    <button type="button" class="btn btn-danger">Danger</button>
    <button type="button" class="btn btn-warning">Warning</button>
    <button type="button" class="btn btn-info">Info</button>
    <button type="button" class="btn btn-light">Light</button>
    <button type="button" class="btn btn-dark">Dark</button>

</div>
@endsection