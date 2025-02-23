@extends('errors::minimal')

@section('title', __('Error 500'))
@section('code', 500)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Server Error'))

