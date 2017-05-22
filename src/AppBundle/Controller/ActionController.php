<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use AppBundle\Entity\User;
use AppBundle\Entity\Alert;
use AppBundle\Entity\FPDF;


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
      //  var_dump($msg_id);
        
        if ($msg_id != NULL){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:User');
    
         $event = $repo->findOneBy(array(
            'cnp' => $user,
         ));
        $event->setCerere($msg_id[0]);

        
        //$item->setCerere($msg_id);
        $em->persist($event);
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
    
    /**
     * @Route("/alert", name="alert")
     */
    public function alertAction(Request $request) {
       
        $em = $this->getDoctrine()->getManager();
        $alert_repo = $em->getRepository('AppBundle:Alert');
    
        //
        $result=  $alert_repo->createQueryBuilder('u')
                 ->select('u.name')
                 ->orderBy('u.id', 'DESC')
                 ->getQuery()
                 ->getArrayResult();
    
        
        $info = $result;
       // var_dump($result);
        return $this->render('functions/alert.html.twig', array('character' => $info));
    }
    
    /**
     * @Route("/alertup", name="alertup")
     */
    public function AlertUpdAction(Request $request) {
        $session = $request->getSession();
        $user = $session->get('logged');
        $em1 = $this->getDoctrine()->getManager();
        $repo = $em1->getRepository('AppBundle:User');
    
        $event = $repo->findOneBy(array(
            'cnp' => $user,
        ));
        $rol = $event->getRole();
        //var_dump($rol);
        $em = $this->getDoctrine()->getManager();
        $msg_alert = $request->request->get('text_alert');
       
        
        if ($rol == 'ROLE_HR' || $rol == 'ROLE_ADMIN')
        {
            if ($msg_alert != NULL)
            {
                $alerta_noua = new Alert();
                $alerta_noua->setName($msg_alert);
           
                $em->persist($alerta_noua);
                $em->flush();
            }
        }
          return $this->redirect($this->generateUrl('alert'));
    }
    
    /**
     * @Route("/solvCerere", name="solvCerere")
     */
    public function solvCerereAction(Request $request)
    {
        $msg_alert = $request->request->get('solvCerere');
        $user = $request->request->get('userCerere');
        
        $em1 = $this->getDoctrine()->getManager();
        $repo = $em1->getRepository('AppBundle:User');
    
        $event = $repo->findOneBy(array(
            'cnp' => $user,
        ));
        $nume = $event->getName();
        $surename = $event->getEmail();
        

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,$nume);
        $pdf->Write('1', $surename);
        $pdf->Output(); 
        var_dump($user);
        var_dump($msg_alert);die;
        
    }
}

