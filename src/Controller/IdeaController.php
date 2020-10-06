<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function list(EntityManagerInterface $em)
    {
        $ideas = $em->getRepository(Idea::class)->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);
        return $this->render('idea/list.html.twig', ["ideas" => $ideas]);
    }

    /**
     * @Route("/{id}", name="idea_detail", requirements={"id": "\d+"})
     */
    public function detail($id, EntityManagerInterface $em) {
       $idea = $em->getRepository(Idea::class)->find($id);
       return $this->render('idea/detail.html.twig', ["idea" => $idea]);
    }

    /**
     * @Route("/add", name="idea_add")
     */
    public function add(EntityManagerInterface $em, Request $request) {
        $idea = new Idea();
        $ideaForm =$this->createForm(IdeaType::class, $idea);
        $ideaForm->handleRequest($request);
        if ($ideaForm->isSubmitted() && $ideaForm->isValid()) {
            $idea->setIsPublished(true);
            $idea->setDateCreated(new \DateTime());
            $em->persist($idea);
            $em->flush();
            $title = $idea->getTitle();
            $this->addFlash("success", "The idea $title has successfully been added.");
            return $this->redirectToRoute("idea_detail", ["id" => $idea->getId()]);
        }
        return $this->render("idea/add.html.twig", ["ideaForm" => $ideaForm->createView()]);
    }
}
