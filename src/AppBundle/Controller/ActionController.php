<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class ActionController extends Controller
{
    /**
     * @Route("/cerere", name="cerere")
     */
    public function cerereAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('logged');
        
        $info = $user;
        return $this->render('functions/cereri.html.twig', array('character' => $info));
    }
    
     /**
     * @Route("/pontaj", name="pontaj")
     */
    public function pontajAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('logged');
       
        $info = $user;
        return $this->render('functions/pontaj.html.twig', array('character' => $info));
    }
}

