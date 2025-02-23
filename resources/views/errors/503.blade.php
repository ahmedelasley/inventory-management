@extends('errors::minimal')

@section('title', __('Error 503'))
@section('code', 503)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Service Unavailable'))

