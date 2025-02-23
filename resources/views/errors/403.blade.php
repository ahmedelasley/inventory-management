@extends('errors::minimal')

@section('title', __('Error 403'))
@section('code', 403)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Forbidden'))

