<?php

namespace VOOTS\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use VOOTS\IndexBundle\Entity\videos;

class IndexController extends Controller
{
    public function indexAction()
    {
          return $this->render('VOOTSIndexBundle:RepIndexView:index.html.twig');
    }
    
    public function aproposAction()
    {
          return $this->render('VOOTSIndexBundle:RepIndexView:apropos.html.twig');
    }
    
    public function videosAction()
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:videos');
        $liste_des_videos = $repository->findAll();
        
        
          return $this->render('VOOTSIndexBundle:RepIndexView:videosIndex.html.twig', array('listeVideos'=>$liste_des_videos));
    }
    
    public function infographiesAction()
    {
          return $this->render('VOOTSIndexBundle:RepIndexView:infographiesIndex.html.twig');
    }

    public function getInfographiesAction(Request $req)
    {
            if($req->isXMLHttpRequest())
            {
         
                    $tagsNames=array((string)$req->get('tag'));
                            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('VOOTSIndexBundle:infographies');                   
                    $liste_des_infographies = $repository->getInfographiesWithTagsArray($tagsNames);

                            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('VOOTSIndexBundle:minivoots');                   
                    $liste_des_minivoots = $repository->getMinivootsWithTagsArray($tagsNames);
                    
                    return new JsonResponse(array('infographies' => $liste_des_infographies, 'minivoots' => $liste_des_minivoots));
            }
            return new Response ("Erreur Ajax", 400);
    }    
    
    public function coupsDeCoeurAction()
    {
        $repository = $this->getDoctrine()
        ->getManager()
        ->getRepository('VOOTSIndexBundle:coupdecoeur');
        $liste_coupsdecoeur = $repository->findAll();
          return $this->render('VOOTSIndexBundle:RepIndexView:coupsDeCoeur.html.twig', array('listecoupsdecoeur'=>$liste_coupsdecoeur));
    }
    
    public function contactAction(Request $request)
    {
        // Create the form according to the FormType created previously.
        // And give the proper parameters
        $form = $this->createForm('VOOTS\IndexBundle\Form\ContactType',null,array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('voots_index_contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            // Refill the fields in case the form is not valid.
            $form->handleRequest($request);

            if($form->isValid()){
                // Send mail
                if($this->sendEmail($form->getData())){

                    // Everything OK, redirect to wherever you want ! :
                    
                    return $this->redirectToRoute('redirect_to_somewhere_now');
                }else{
                    // An error ocurred, handle
                    var_dump("Errooooor :(");
                }
            }
        }

        return $this->render('VOOTSIndexBundle:RepIndexView:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    private function sendEmail($data){
        $myappContactMail = 'mycontactmail@mymail.com';
        $myappContactPassword = 'yourmailpassword';
        
        // In this case we'll use the ZOHO mail services.
        // If your service is another, then read the following article to know which smpt code to use and which port
        // http://ourcodeworld.com/articles/read/14/swiftmailer-send-mails-from-php-easily-and-effortlessly
        $transport = \Swift_SmtpTransport::newInstance('smtp.zoho.com', 465,'ssl')
            ->setUsername($myappContactMail)
            ->setPassword($myappContactPassword);

        $mailer = \Swift_Mailer::newInstance($transport);
        
        $message = \Swift_Message::newInstance("Our Code World Contact Form ". $data["subject"])
        ->setFrom(array($myappContactMail => "Message by ".$data["name"]))
        ->setTo(array(
            $myappContactMail => $myappContactMail
        ))
        ->setBody($data["message"]."<br>ContactMail :".$data["email"]);
        
        return $mailer->send($message);
    }
}
