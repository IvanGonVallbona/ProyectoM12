@extends('layouts.app')

@section('title', 'Home')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div>
      <img src="{{ asset ('img/logo.png') }}" alt="">
      <h2>M12 Proyecto Final</h2>
      <hr>
      <h3>Que alguien me mate. Solo para conseguir esto ya he perdido 2 meses de vida</h3>
    </div>
@endsection