@extends('layout2.loginlayout')
@section('content')
<?php
echo Auth::user();
?>
 
          <div class = "header">
            <h1>Login</h1>
          </div>
          <div style = "margin-top:30px">
          </div>

			<div class="content">
				<center>
				<form class="pure-form pure-form-aligned" method="POST" action="/auth/login">
					 {!! csrf_field() !!}

					  @if (count($errors) > 0)
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li style ="color:red">{{ $error }}</li>
				            @endforeach
				        </ul>
			         @endif
				    <fieldset>
				        <div class="pure-control-group">
				            <label for="name">Username</label>
				            <input id="name" name = "name" type="text" autocomplete="off" required placeholder="Username" value = "{{ old('email') }}">
				        </div>

				        <div class="pure-control-group">
				            <label for="password">Password</label>
				            <input id="password" name = "password" type="password" required placeholder="Password">
				        </div>
				        <div class="pure-controls">
				            <button type="submit" class="pure-button pure-button-primary">Login</button>
				        </div>
				    </fieldset>
				</form>
				</center>
			</div><!-- class='content'-->
	
@stop