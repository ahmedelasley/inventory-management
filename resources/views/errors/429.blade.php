@extends('errors::minimal')

@section('title', __('Error 429'))
@section('code', 429)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Too Many Requests'))

