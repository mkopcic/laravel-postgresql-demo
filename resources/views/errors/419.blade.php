@extends('errors::minimal')

@section('title', 'Sesija istekla')
@section('code', '419')
@section('message', 'Sesija je istekla')
@section('description', 'Tvoja sesija je istekla zbog neaktivnosti ili je CSRF token nevažeći. Vrati se natrag i pokušaj ponovo.')
@section('icon', 'ti-clock-x')
@section('color', 'text-purple')
@section('avatar-bg', 'bg-purple-lt')
