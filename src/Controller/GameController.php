<?php

namespace App\Controller;

use App\Service\Database;
use App\Service\Rule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\BetRepository;
use App\Repository\PublicFigureRepository;

class GameController extends AbstractController
{
    private $database;
    private $rule;
    private $gameRepository;
    private $userRepository;
    private $betRepository;

    public function __construct(Database $database, Rule $rule)
    {
        $this->database = $database->getDatabase();
        $this->rule = $rule;
        $this->gameRepository = new GameRepository($this->database);
        $this->userRepository = new UserRepository($this->database);
        $this->betRepository = new BetRepository($this->database);
        $this->publicFigureRepository = new PublicFigureRepository($this->database);
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

        $publicFigures = $this->publicFigureRepository->findAll();
        $gameUsers = $this->userRepository->findGameUsers($gameId);
        $bets = $this->betRepository->find($gameId);

        $results = $this->rule->getResults($game->getYear()->format('Y'), $bets, $publicFigures);

        return $this->render('game/details.html.twig', [
            'page_title' => 'Partie '.$game->getLabel(),
            'game' => $game,
            'game_users' => $gameUsers,
            'bets' => $bets,
            'public_figures' => $publicFigures,
            'results' => $results
        ]);
    }
}
