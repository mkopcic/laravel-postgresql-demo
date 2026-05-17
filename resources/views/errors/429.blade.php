@extends('errors::minimal')

@section('title', 'Previše zahtjeva')
@section('code', '429')
@section('message', 'Previše zahtjeva')
@section('description', 'Poslao/la si previše zahtjeva u kratkom vremenskom roku. Pričekaj trenutak pa pokušaj ponovo.')
@section('icon', 'ti-hand-stop')
@section('color', 'text-orange')
@section('avatar-bg', 'bg-orange-lt')
