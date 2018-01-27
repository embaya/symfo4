<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

Class PagesController
{
    /**
     * @Route("/")
     *
     * @param Environment $twig
     * @return Response
     */
     public function index(Environment $twig){
        return new Response($twig->render('pages/index.html.twig'));
    }
}