<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AccountRepository; 

class ApiLoginController extends AbstractController
{
	public function index(
			Request $req,
			AccountRepository $ar
	): Response
	{	
		$json = json_decode($req->getContent(), true);

		$email = $json['email'];
		$password = $json['password'];

		$user = $ar->findOneByEmail($email);
		if (!$user) 
		{
			return $this->json($status = 404);
		}

		if (password_verify($password, $user->getPassword()) == 0)
		{
			$status = 'Błędne hasło';
			$data = array('status' => $status);
			return $this->json($data);
		}

		$data = array(
			'status' => $status,
			'email' => $email
		);
		
		return $this->json($data, $status = 200);
	}
}
