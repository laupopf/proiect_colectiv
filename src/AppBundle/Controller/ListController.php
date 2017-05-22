<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Alert;


class ListController extends Controller
{
	/**
	* @Route("/", name="welcome")
	*/
    public function showAction(Request $request)
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();
        
        
        
        if ($usr != "anon.")
        {
             
            
            $em = $this->getDoctrine()->getManager();
            $alert_repo = $em->getRepository('AppBundle:Alert');
    
        
            $result=  $alert_repo->createQueryBuilder('u')
                 ->select('u.name')
                 ->orderBy('u.id', 'DESC')
                 ->getQuery()
                 ->getArrayResult();
    
        
            $info = $result;
            
            
            $cnp = $usr->getCnp();
            // set and get session attributes
            $session = $request->getSession();
            $session->set('logged', $cnp);
            
            $conn = $this->get('database_connection');
            if ($usr->getRole() == "ROLE_USER")
            {
                
                $sql = "SELECT * FROM user WHERE cnp=".$usr->getCnp();
            
                $stmt = $conn->query($sql); 
                $stmt->execute();
                $information = $stmt->fetchAll();
            }
            else
            {
                $users= $conn->fetchAll('select * from user');
                
                    return $this->render('default/index.html.twig', array('character' => $users , 'alert' => $info));
            }
        return $this->render('default/index.html.twig', array('character' => $information, 'alert' => $info));
    }
    return $this->render('default/index.html.twig');
    }
}