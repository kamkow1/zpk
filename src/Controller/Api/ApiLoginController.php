<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiLoginController extends AbstractController
{
	public function index(Request $req): Response
	{	
		$json = json_decode($req->getContent(), true);
		return $this->json(
			array(
				'email' => $json["email"],
			)
		);
	}
}
