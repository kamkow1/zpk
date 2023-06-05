<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ErrorMessage 
{
	public string $text = 'Unknown Error has occured';
}
