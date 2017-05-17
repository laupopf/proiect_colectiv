<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use AppBundle\Entity\User;


class ActionController extends Controller
{
    /**
     * @Route("/cerere", name="cerere")
     */
    public function cerereAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('logged');
        
        $msg_id = $request->request->get('message-checkbox');
        var_dump($msg_id);
        
        if ($msg_id != NULL){
        $em = $this->getDoctrine()->getEntityManager();
        
        $item = $em->getRepository('AppBundle\Entity\User')->find($user);

        
        //$item->setCerere($msg_id);

        $em->flush();
        }
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

