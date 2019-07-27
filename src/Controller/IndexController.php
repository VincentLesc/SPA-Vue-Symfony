<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/{vueRouter}/{action}/{id}", name="index", requirements={"vueRouter"="^(?!api|_(profiler|wdt)).*"})
     */
    public function index( $vueRouter = null ,$action = null, $id = null)
    {
        return $this->render('base.html.twig', []);
    }
}
