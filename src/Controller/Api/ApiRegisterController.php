<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AccountRepository;
use App\Entity\Account;

class ApiRegisterController extends AbstractController
{
	public function index(Request $req, AccountRepository $ar): Response
	{	
		$json = json_decode($req->getContent(), true);

		$email = $json['email'];
		$password = $json['password'];
		$phone = $json['phone'];

		$user = $ar->findOneByEmail($email);
		$status = 'OK';
		if ($user) 
		{
			$status = 'Użytkownik o takim emailu jest już zarejestrowany';
			$data = array('status' => $status);
			return $this->json($data);
		}

		$a = new Account();
		$a->setEmail($email);
		$a->setPassword($password);
		$a->setPhone($phone);
		$ar->save($a, true);

		$data = array('status' => $status);
		return $this->json($data);
	}
}
