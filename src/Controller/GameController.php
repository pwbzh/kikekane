<?php
namespace App\Controller;

use App\Service\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database->getDatabase();
    }

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
