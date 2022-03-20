<?php

namespace App\Controller;

use App\Service\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Repository\UserRepository;

class GameController extends AbstractController
{
    private $database;
    private $gameRepository;
    private $userRepository;

    public function __construct(Database $database)
    {
        $this->database = $database->getDatabase();
        $this->gameRepository = new GameRepository($this->database);
        $this->userRepository = new UserRepository($this->database);
    }

    /**
    * @Route("/")
    * @Route("/games/", name="games_list")
    */
    public function list(): Response
    {
        $games = $this->gameRepository->findAll();

        $usersByGames = array();

        if ($games) {
            foreach ($games as $game) {
                $usersByGames[$game->getId()] = $this->userRepository->findGameUsers($game->getId());
            }
        }

        return $this->render('game/list.html.twig', [
            'page_title' => 'Parties',
            'games' => $games,
            'users_by_games' => $usersByGames
        ]);
    }

    /**
    * @Route("/games/{gameId}", name="games_details", requirements={"gameId"="\d+"})
    */
    public function details(int $gameId): Response
    {
        $game = $this->gameRepository->find($gameId);

        if (!$game) {
            throw $this->createNotFoundException();
        }

        $gameUsers = $this->userRepository->findGameUsers($gameId);

        return $this->render('game/details.html.twig', [
            'page_title' => 'Partie '.$game->getLabel(),
            'game' => $game,
            'game_users' => $gameUsers
        ]);
    }
}
