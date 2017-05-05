<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
                
                    return $this->render('default/index.html.twig', array('character' => $users));
            }
        return $this->render('default/index.html.twig', array('character' => $information));
    }
    return $this->render('default/index.html.twig');
    }
}