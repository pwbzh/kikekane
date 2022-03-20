<?php

namespace App\Controller;

use App\Service\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    private $database;
    private $userRepository;

    public function __construct(Database $database)
    {
        $this->database = $database->getDatabase();
        $this->userRepository = new UserRepository($this->database);
    }

    /**
    * @Route("/users/", name="users_list")
    */
    public function list(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('user/list.html.twig', [
            'page_title' => 'Joueurs',
            'users' => $users,
        ]);
    }
}
