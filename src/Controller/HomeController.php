<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
	public function index(): Response
	{
		$html = <<<HTML
			<html>
			<body>
				<h1>Siema</h1>
			</body>
			</html>
		HTML;

		return new Response($html);
	}
}
