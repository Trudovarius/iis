<?php 

class LogoutController extends Controller
{
	public function handle($parameters)
	{
		unset($_SESSION['user']);
		session_destroy();

		$this->redirect('home');
	}
}