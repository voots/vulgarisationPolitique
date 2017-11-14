<?php

namespace VOOTS\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use VOOTS\IndexBundle\Entity\videos;
use VOOTS\IndexBundle\Entity\definition;

class IndexController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:tag');
        $liste_des_tags = $repository->findAll();
        
          return $this->render('VOOTSIndexBundle:RepIndexView:index.html.twig', array('listeTags'=>$liste_des_tags));
    }
    
    public function aproposAction()
    {
          return $this->render('VOOTSIndexBundle:RepIndexView:apropos.html.twig');
    }

     public function associationsAction()
    {
          return $this->render('VOOTSIndexBundle:RepIndexView:associations.html.twig');
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
    
    public function pageStandardAction($tag)
    {
         //on cherche la définition
         $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:definition');       
         $definition = $repository->getOneDefinitionWithTagsArray(array($tag));
         //on cherche l'explication
         $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:explication');       
         $explication = $repository->getOneExplicationWithTagsArray(array($tag));
         //on cherche les infographies
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:infographies');                
        $liste_des_infographies = $repository->getInfographiesWithTagsArray(array($tag));
         //on cherche la vidéo principale
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:videos');                   
        $video_principale = $repository->getVideoPrincipaleWithTagsArray(array($tag));         
         //on cherche les videos
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('VOOTSIndexBundle:videos');                   
        $liste_des_videos_associees = $repository->getVideosWithTagsArray(array($tag)); 
        $enSavoirPlus = null;
         return $this->render('VOOTSIndexBundle:RepIndexView:pageStandard.html.twig', 
                 array('definition'=>$definition, 
                     'explication'=>$explication, 
                     'infographies' => $liste_des_infographies, 
                     'video_principale' => $video_principale, 
                     'enSavoirPlus' => $enSavoirPlus, 
                     'videos_associees'=> $liste_des_videos_associees));
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
