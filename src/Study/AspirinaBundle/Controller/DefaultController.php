<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AspirinaBundle:Default:index.html.twig', array('name' => $name));
    }
}
