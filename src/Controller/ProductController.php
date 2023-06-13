<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\{Response, Request};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ProductRepository;


class ProductController extends AbstractController
{
	public function index(
			Request $req,
			ProductRepository $pr
	): Response
	{
		$type = $req->query->get('type');
		$products = null;
		if ($type == 'sale') {
			$products = $pr->getAllOnSale(true);
		} else {
			$products = $pr->getAllByType($type, true);	
		}

		return $this->render('products.html.twig', [
			'products' => $products
		]);
	}
}
