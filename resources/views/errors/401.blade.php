@extends('errors::minimal')

@section('title', __('Error 401'))
@section('code', 401)
@section('type', class_basename($exception))
@section('message', __('Unauthorized'))

