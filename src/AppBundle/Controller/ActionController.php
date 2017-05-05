<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ActionController extends Controller
{
    /**
     * @Route("/cerere", name="cerere")
     */
    public function cerereAction(Request $request)
    {
        
    }
    
     /**
     * @Route("/pontaj", name="pontaj")
     */
    public function pontajAction(Request $request)
    {
    
    }
}

