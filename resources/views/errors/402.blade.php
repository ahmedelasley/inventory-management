@extends('errors::minimal')

@section('title', __('Error 402'))
@section('code', 402)
@section('type', class_basename($exception))
@section('message', __('Payment Required'))

