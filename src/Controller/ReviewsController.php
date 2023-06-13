<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ReviewRepository;
use App\Repository\AccountRepository;
use App\Entity\Review;

class ReviewsController extends AbstractController
{
	public function index(ReviewRepository $rr): Response
	{
		$reviews = $rr->findAll();

		return $this->render('reviews.html.twig', [
			'reviews' => $reviews
		]);
	}

	public function create(
			Request $req,
			AccountRepository $ar,
			ReviewRepository $rr
	): Response
	{
		$json = json_decode($req->getContent(), true);

		$email = $json['email'];
		$review = $json['review'];
		
		$user = $ar->findOneByEmail($email);
		if (!$user)
		{
			return $this->json($status = 404);
		}

		$r = new Review();
		$r->setText($review);
		$r->setAccount($user);
		$rr->save($r, true);

		return $this->json($user);
	}
}
