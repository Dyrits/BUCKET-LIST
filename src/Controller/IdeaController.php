<?php

namespace App\Controller;

use App\Entity\Idea;
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
    public function add(EntityManagerInterface $em) {
        $idea = new Idea();
        $idea->setTitle("Another idea...");
        $idea->setAuthor("Dylan J. Gerrits");
        $idea->setDescription("I have no idea...");
        $idea->setIsPublished(true);
        $idea->setDateCreated(new \DateTime());
        $em->persist($idea);
        $em->flush();
        $ideas = $em->getRepository(Idea::class)->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);
        return $this->render('idea/list.html.twig', ["ideas" => $ideas]);
    }
}
