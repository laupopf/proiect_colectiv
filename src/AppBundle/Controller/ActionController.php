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
use AppBundle\Entity\Cereri;


class ActionController extends Controller
{
    /**
     * @Route("/cerere", name="cerere")
     */
    public function cerereAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('logged');
        
        $emc = $this->getDoctrine()->getManager();
        $repoc = $emc->getRepository('AppBundle:Cereri');
        $primit = $repoc->findOneBy(array(
            'cnp' => $user,
        ),
                array('id' => 'DESC'));
        if ($primit != NULL){
            $link = $primit->getLink();
        }
        else {
            $link = NULL;
        }
        
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
        return $this->render('functions/cereri.html.twig', array('character' => $info , 'link' => $link));
    }
    
     /**
     * @Route("/pontaj", name="pontaj")
     */
    public function pontajAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('logged');
        
        $msg = $request->request->get('pontaj');
        
        if ($msg != NULL){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:User');
        
        $event = $repo->findOneBy(array(
            'cnp' => $user,
         ));
        $old_luna = $event->getPontajLuna();
        $new_pontaj = $old_luna + $msg;
        $event->setPontajZi($msg);
        $event->setPontajLuna($new_pontaj);
        
        $time = $event->getDataAngajare()->format('Y-m-d H:i:s');
        
        //$time3 = $time2 - $time;
        $diff = time()-strtotime($time);
        $back = gmdate("H:i:s", $diff);
        var_dump($back);
        die;
        //$item->setCerere($msg_id);
        $em->persist($event);
        $em->flush();
        }
        
        $info = $msg;
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
        $surename = $event->getSurename();
        $cnp = $event->getCnp();
        $telefon = $event->getPhoneNumber();
        $data_nastere = date_format($event->getDataNastere(), 'Y-m-d');
        $data_angajare = date_format($event->getDataAngajare(), 'Y-m-d');
        $email = $event->getEmail();
        $salar = $event->getSalar();
        $data_sf = date_format($event->getSfContract(), 'Y-m-d');
     
        if ($msg_alert == "1")
        {
            $tipul_cereri = 'Cerere de concediu';
            $cerinta = 'doresc concediu pe perioada 2.06 - 12.06.2017 pe motive personale.';
        }
        if ($msg_alert == '2')
        {
            $tipul_cereri = 'Adeverinta de venit';
            $cerinta = ', salarul este de '.$salar;
        }                                                                  
        if ($msg_alert == '3')
        {
            $tipul_cereri = 'Copie dupa contractul de angajare';
            $cerinta = ', contractul expira la data de: '.$data_sf.' cu venit lunar de: '.$salar;
        }                

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,$tipul_cereri);
        $pdf->MultiCell(40,10,'');
        $pdf->Cell(40,10,'Subsemnatul '.$nume.' '.$surename.' cu CNP: '.$cnp);
        $pdf->Ln(10);
        $pdf->Cell(40,10,' nascut la data de '.$data_nastere.', '.'angajat al firmei Minus+ din data de: ');
        $pdf->Ln(10);
         
        $pdf->Cell(40,10,$data_angajare.' '. $cerinta);
        $pdf->Ln(10);
        $pdf->Cell(40,10,'Contact la numarul de telefon: '.$telefon.' sau email: '.$email.'. Va multumesc!');
       
        $serv= $_SERVER['DOCUMENT_ROOT'];
        
        $filename=$serv.'/'.'web'.$tipul_cereri.$nume.$surename.".pdf";
        
        $pdf->Output($filename,'F');
        
        
        $emc = $this->getDoctrine()->getManager();
        //$repoc = $emc->getRepository('AppBundle:Cereri');
        
        $cerere = new Cereri();
        $cerere->setNume($nume);
        $cerere->setCnp($cnp);
        $cerere->setLink('web'.$tipul_cereri.$nume.$surename.".pdf");
        $cerere->setTip($msg_alert);
        
        $emc->persist($cerere);
        $emc->flush();
        
                      
        $event->setCerere('0');
   
        $em1->flush();
        
        return $this->redirect($this->generateUrl('welcome'));
      
    }
}

