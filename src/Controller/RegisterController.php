<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AccountRepository;
use App\Entity\Account;

class RegisterController extends AbstractController
{
	public function index(): Response
	{
		return $this->render('register.html.twig');
	}
	
	public function create(
			Request $req,
			AccountRepository $ar
	): Response
	{	
		$json = json_decode($req->getContent(), true);

		$email = $json['email'];
		$password = $json['password'];
		$phone = $json['phone'];

		$user = $ar->findOneByEmail($email);
		if ($user) 
		{
			return $this->json($status = 409);
		}
		else
		{
			$password = password_hash($password, PASSWORD_BCRYPT);

			$a = new Account();
			$a->setEmail($email);
			$a->setPassword($password);
			$a->setPhone($phone);
			$ar->save($a, true);
		}

		return $this->json($status = 201);
	}
}
