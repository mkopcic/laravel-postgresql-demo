@extends('errors::minimal')

@section('title', 'Greška poslužitelja')
@section('code', '500')
@section('message', 'Interna greška poslužitelja')
@section('description', 'Nešto je pošlo po krivu na našoj strani. Naš tim je obaviješten. Pokušaj ponovo za koji trenutak.')
@section('icon', 'ti-server-off')
@section('color', 'text-red')
@section('avatar-bg', 'bg-red-lt')
