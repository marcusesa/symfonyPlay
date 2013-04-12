<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $openDcfs = count($em->getRepository('AspirinaBundle:Dcf')->findBy(array('status' => 0)));
        $closeDcfs = count($em->getRepository('AspirinaBundle:Dcf')->findBy(array('status' => 1)));
        $totalDcfs = $openDcfs + $closeDcfs;
        $totalSubjects = count($em->getRepository('AspirinaBundle:Subject')->findAll());
        $totalSites = count($em->getRepository('AspirinaBundle:Site')->findAll());
        
        return array(
            'openDcfs' => $openDcfs,
            'closeDcfs' => $closeDcfs,
            'totalDcfs' => $totalDcfs,
            'totalSubjects' => $totalSubjects,
            'totalSites' => $totalSites,
        );
    }

}
