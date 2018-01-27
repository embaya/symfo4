<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index(Request $request, Environment $twig, RegistryInterface $doctrine, FormFactoryInterface $formFactory)
    {
        $posts = $doctrine->getRepository(Post::class)->findAll();
        // replace this line with your own code!
        $form = $formFactory->createBuilder(PostType::class, $posts[0])->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getEntityManager()->flush();
        }
        return new Response($twig->render("posts/index.html.twig", array('posts' => $posts,
            'form' => $form->createView())));
    }
}
