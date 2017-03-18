<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;

/**
* @Route("/admin/user")
* @Method("GET")
*/
class AdminUserController extends Controller
{
   // $em = $this->getDoctrine()->getManager();
   // $users = $em->getRepository(User::class)->findBy([], ['username' => 'asc']);
   //
   // return $this->render('admin/user/index.html.twig', [
   //    'users' => $users,
   // ]);
}
