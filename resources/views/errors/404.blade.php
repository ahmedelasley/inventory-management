@extends('errors::minimal')

@section('title', __('Error 404'))
@section('code', 404)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Not Found'))

