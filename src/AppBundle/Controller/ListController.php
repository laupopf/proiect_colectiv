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
        var_dump($usr->getRole());
        
        $information = [
          $usr->getName(),
          $usr->getSurename(),
          $usr->getCnp(),
          $usr->getPhoneNumber(),
          $usr->getEmail(),
          $usr->getSalar(),
          $usr->getRole()];

        return $this->render('default/index.html.twig', array('character' => $information));
    }
    return $this->render('default/index.html.twig');
    }
}