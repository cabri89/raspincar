<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
   /**
   * @Route("/login")
   */
   public function loginAction()
   {
      $authenticationUtils = $this->get('security.authentication_utils');

      return $this->render('AppBundle:Security:login.html.twig', [
         'lastUsername' => $authenticationUtils->getLastUsername(),
         'error' => $authenticationUtils->getLastAuthenticationError(),
      ]);
   }
}
