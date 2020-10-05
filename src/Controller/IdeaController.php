<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/idea")
 */
class IdeaController extends AbstractController
{
    /**
     * @Route("/", name="idea_list")
     */
    public function list()
    {
        //@todo : Récupérer les tâches en BDD.
        return $this->render('idea/list.html.twig', []);
    }

    /**
     * @Route("/{id}", name="idea_detail", requirements={"id": "\d+"})
     */
    public function detail($id, Request $request) {
        //@todo : Récupérer la tâche en BDD.
        return $this->render('idea/detail.html.twig', ["id" => $id]);
    }
}
