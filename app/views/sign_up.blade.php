@extends('_1_base_view')

@section('body')
  <div class= "container">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <a class="navbar-brand" href='/'>Concoction Keeper</a>
    </div>
    <br>
    <div class="col-md-4">
      @if(Session::get('flash_message'))
      <div class='alert alert-danger container'>
       {{ Session::get('flash_message') }}
      </div>
       @endif    
      <h1>Sign up</h1>

      <div>
      	{{ Form::open(array('url'=>'/sign-up')) }}
      	
        <table class='table'>
          <tr>
            <td>{{ Form::label('name_label', 'Name')}}</td>
            <td>{{ Form::text('name')}}</td>
          </tr>
          <tr>
            <td>{{ Form::label('email_label', 'Email address')}}</td>
            <td>{{ Form::text('email')}}</td>
          </tr>
          <tr>
            <td>{{ Form::label('password_label', 'Password')}}</td>
            <td>{{ Form::password('password')}}</td>
          </tr>
        </table>
          {{ Form::submit('Submit', array('class'=>'btn btn-lg btn-success')) }}
          {{ Form::close() }}
      	</div>
    </div>
</div>
@stop