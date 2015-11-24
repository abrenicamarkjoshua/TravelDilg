<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
class loginController extends Controller{
	public function getIndex(){
		$username = "Mark Joshua R. Abrenica";
	$links =[
				
			];
		$data =
		[
			'username' => $username,
			'links' => $links
			
		
		];
		return view('login', $data);
	}
	public function postIndex(){
		$username = "Mark Joshua R. Abrenica";
		$links =[
				
			];
		$data =
		[
			'username' => $username,
			'links' => $links
			
		
		];
		return view('login', $data);
	}

}
?>