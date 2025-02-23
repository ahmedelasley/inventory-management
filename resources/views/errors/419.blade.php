@extends('errors::minimal')

@section('title', __('Error 419'))
@section('code', 419)
@section('type', class_basename($exception))
@section('message',  __($exception->getMessage() ?: 'Page Expired'))

