<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    /**
     * @Route("/compte/")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        return  $this->render('AppBundle:Default:index.html.twig');
    }
}
