<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app.home')]
    public function index(ArticlesRepository $repo): Response
    {
        $featured = $repo->findOneBy(["isFeatured" => "true"]);

        $latest = $repo->findLatestArticles();

        return $this->render('home/index.html.twig', [
            'featured' => $featured,
            "latestArticles" => $latest,
        ]);
    }
}
