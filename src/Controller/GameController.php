<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController
{
    /**
    * @Route("/games/")
    */
    public function list(): Response
    {
        return new Response(
            '<html><body><h2>Parties</h2></body></html>'
        );
    }
}
