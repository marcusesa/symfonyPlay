<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Trail controller.
 *
 * @Route("/trail")
 */
class TrailController extends Controller
{
    /**
     * @Route("/", name="trail")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('Gedmo\Loggable\Entity\LogEntry')->findAll();
        
        return array(
            'entities' => $entities,
        );
    }

}
