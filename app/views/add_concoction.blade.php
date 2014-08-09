@extends('_4_add_or_edit_concoction')

@section('title')
  	Add concoction
@stop

@section('add_or_edit_concoction_header')
	<h1>Add concoction</h1>
@stop

@section('add_or_edit_concoction_url')
	{{ Form::open(array('url'=>'/add-concoction/', 'files'=>true)) }}
@stop

@section('add_or_edit_concoction_submit')
	{{ Form::submit('Add concoction!', array('class'=>'btn btn-lg btn-primary')) }}
@stop