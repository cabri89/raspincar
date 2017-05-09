<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\EditUserType;

/**
* @Route("/admin/user")
* @Method("GET")
*/
class AdminUserController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findBy(['roles' => 'ROLE_USER'], ['username' => 'asc']);

        return $this->render('AppBundle:AdminUser:index.html.twig', [
			'users' => $users,
		 ]);
    }
	
	/**
    * @Route("/{id}/usertoggle", requirements={"id":"\d+"})
    * @Method("GET|POST")
    */
	public function toggleuserAction(Request $request, User $user)
	{
        if (null === $token = $request->query->get('_token')) {
            throw $this->createAccessDeniedException('Token missing');
        }

        if (!$this->isCsrfTokenValid('TOGGLE_USER_TOKEN', $token)) {
            throw $this->createAccessDeniedException('Invalid token');
        }
		
        $em = $this->getDoctrine()->getManager();
		$user->setIsActive(!$user->getIsActive());
		$em->persist($user);
        $em->flush();

        $this->addFlash('Success', 'Voiture modifié avec succès !');

        return $this->redirectToRoute('app_adminuser_index');
	}
	
	/**
    * @Route("/{id}/edit", requirements={"id":"\d+"})
    * @Method("GET|POST")
    */
	public function edituserAction(Request $request, User $user)
	{
        $edituserForm = $this->createForm(EditUserType::class, $user);

        $edituserForm->handleRequest($request);

        if ($edituserForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', 'Voiture modifié avec succès !');
			
            return $this->redirectToRoute('app_adminuser_edituser', array('id' => $cuser->getId()));
        }

        return  $this->render('AppBundle:AdminUser:index.html.twig', [
            'user' => $user,
            'edituserForm' => $edituserForm->createView(),
        ]);
	}
}
