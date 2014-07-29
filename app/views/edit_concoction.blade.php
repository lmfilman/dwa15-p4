@extends('_4a_add_or_edit_concoction')

@section('title')
  	Edit concoction
@stop

@section('add_or_edit_concoction_header')
  	<div>Edit concoction <?php echo $id; ?></div>
@stop

@section('add_or_edit_concoction_url')
	{{ Form::open(array('url'=>'/edit-concoction/'.$id)) }}
@stop

@section('add_or_edit_concoction_submit')
	{{ Form::submit('Edit concoction!') }}
@stop