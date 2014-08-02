@extends('_4_add_or_edit_concoction')

@section('title')
  	Add concoction
@stop

@section('add_or_edit_concoction_header')
	<div>Add concoction</div>
@stop

@section('add_or_edit_concoction_url')
	{{ Form::open(array('url'=>'/add-concoction')) }}
@stop

@section('add_or_edit_concoction_submit')
	{{ Form::submit('Add concoction!') }}
@stop