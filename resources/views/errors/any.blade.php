@extends('errors::minimal')

@section('title', __('Error nay'))
@section('code', 'any')
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Service Unavailable'))

