@extends('layout2.loginlayout')
@section('content')
			<div class="content">
			    
				<form class="pure-form pure-form-aligned" action = '' method = 'post'>
				    <fieldset>
				        <div class="pure-control-group">
				            <label for="name">Username</label>
				            <input id="name" type="text" placeholder="Username">
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