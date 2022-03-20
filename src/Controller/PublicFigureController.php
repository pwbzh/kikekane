<?php

namespace App\Controller;

use App\Service\Database;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PublicFigureRepository;

class PublicFigureController extends AbstractController
{
    private $database;
    private $publicFigureRepository;

    public function __construct(Database $database)
    {
        $this->database = $database->getDatabase();
        $this->publicFigureRepository = new PublicFigureRepository($this->database);
    }

    /**
    * @Route("/public-figures/", name="public_figures_list")
    */
    public function list(): Response
    {
        $publicFigures = $this->publicFigureRepository->findAll();

        return $this->render('public_figure/list.html.twig', [
            'page_title' => 'Personnalités',
            'public_figures' => $publicFigures,
        ]);
    }
}
