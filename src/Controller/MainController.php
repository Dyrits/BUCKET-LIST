<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class MainController extends Controller
{
    /**
     * @Route("/", name="default_home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");
    }
}