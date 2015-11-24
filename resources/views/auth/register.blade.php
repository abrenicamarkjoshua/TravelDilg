@extends('layout2.loginlayout')
@section('content')
			<div class="content">
			    
				<form class="pure-form pure-form-aligned" method="POST" action="/auth/register">
					 {!! csrf_field() !!}
				    <fieldset>
				        <div class="pure-control-group">
				            <label for="name">Name</label>
				            <input id="name" name = "name" type="text" placeholder="Username" value = "{{ old('name') }}">
				        </div>
			        	<div class="pure-control-group">
				            <label for="name">Email</label>
				            <input id="email" name = "email" type="text" placeholder="Email" value = "{{ old('email') }}">
				        </div>

				        <div class="pure-control-group">
				            <label for="password">Password</label>
				            <input id="password" type="password" placeholder="Password">
				        </div>
				        <div class="pure-controls">
				            <button type="submit" class="pure-button pure-button-primary">Login</button>
				        	<button type="submit" class="pure-button pure-button-secondary">Cancel</button>
				        </div>
				    </fieldset>
				</form>

			</div><!-- class='content'-->
	
@stop