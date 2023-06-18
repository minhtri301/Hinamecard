@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'USER DOES NOT HAVE THE RIGHT ROLES.'))
