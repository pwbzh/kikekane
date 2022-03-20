<?php

namespace App\Controller;

use App\Service\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;

class GameController extends AbstractController
{
    private $database;
    private $gameRepository;

    public function __construct(Database $database)
    {
        $this->database = $database->getDatabase();
        $this->gameRepository = new GameRepository($this->database);
    }

    /**
    * @Route("/")
    * @Route("/games/", name="games_list")
    */
    public function list(): Response
    {
        $games = $this->gameRepository->findAll();

        return $this->render('game/list.html.twig', [
            'games' => $games,
        ]);
    }
}
