<?php

namespace App\Controllers;

class Home extends BaseController
{
	    # INDEX
		public function index()
		{
			return view('includes/head') . view('home');
		}
}
