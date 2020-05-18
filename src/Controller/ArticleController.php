<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     * 
     */
    public function index(ArticleRepository $repoArticle, CategoryRepository $repoCategory): Response
    {

        $articles = $repoArticle->findAll();
        $categories = $repoCategory->findAll();

        return $this->render('blog/article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    /** 
     * Permet d'afficher un seul article
     * 
     * @Route("/article/{slug}", name="article_show")
     * 
     * @return Response
     */
    public function show($slug, ArticleRepository $repo) {
        // Je récupère l'article qui correspong au bon slug
        $article = $repo->findOneBySlug($slug);

        return $this->render('blog/article/show.html.twig', [
            'article' => $article
        ]);
    }
}
