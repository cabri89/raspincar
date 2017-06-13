<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Car;
use AppBundle\Form\UserType;

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
    $users = $em->createQuery("SELECT COUNT(u.id) FROM \AppBundle\Entity\User u WHERE u.roles='ROLE_USER'")
                ->getSingleScalarResult();

    $cars = $em->createQuery("SELECT COUNT(c.id) FROM \AppBundle\Entity\Car c")
               ->getSingleScalarResult();

    $maintenances = $em->createQuery("SELECT COUNT(m.id) FROM \AppBundle\Entity\Maintenance m")
                       ->getSingleScalarResult();

    $connection = $em->getConnection();
    $statement = $connection->prepare("SELECT u.email as email_user, COUNT(c.id) as max_car
                                       FROM raspincar.user u, raspincar.car c
                                       WHERE u.id = c.user_id
                                       GROUP BY c.user_id");
    $statement->execute();
    $max_cars = $statement->fetchAll();

    $statement = $connection->prepare("SELECT c.marque, c.modele, c.couleur, c.premiere_immat, c.kilometres, COUNT(m.id) as max_maintenance
                                       FROM raspincar.car c, raspincar.maintenance m
                                       WHERE c.id = m.car_id
                                       GROUP BY m.car_id");
    $statement->execute();
    $max_maintenances = $statement->fetchAll();

    $statement = $connection->prepare("SELECT c.marque, COUNT(c.marque) as nb_marque
                                       FROM raspincar.car c
                                       GROUP BY c.marque
                                       ORDER BY nb_marque desc
                                       LIMIT 3");
    $statement->execute();
    $nbmarque = $statement->fetchAll();

    $array_cars[1] = 0;
    foreach ($max_cars as $car) {
      if($car["max_car"] > $array_cars[1]) {
        $array_cars[0] = $car["email_user"];
        $array_cars[1] = $car["max_car"];
      }
    }

    $array_maintenances[5] = 0;
    foreach ($max_maintenances as $maintenance) {
      if($maintenance["max_maintenance"] > $array_maintenances[5]) {
        $array_maintenances[0] = $maintenance["marque"];
        $array_maintenances[1] = $maintenance["modele"];
        $array_maintenances[2] = $maintenance["couleur"];
        $array_maintenances[3] = $maintenance["premiere_immat"];
        $array_maintenances[4] = $maintenance["kilometres"];
        $array_maintenances[5] = $maintenance["max_maintenance"];
      }
    }

    return $this->render('AppBundle:AdminUser:index.html.twig', [
	    'users' => $users,
	    'cars' => $cars,
	    'maintenances' => $maintenances,
	    'max_cars' => $array_cars,
	    'max_maintenances' => $array_maintenances,
	    'nbmarque' => $nbmarque,
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
    * @Route("/{id}/userupdate", requirements={"id":"\d+"})
    * @Method("GET|POST")
    */
	public function updateUserAction(Request $request, User $user)
	{
        $edituserForm = $this->createForm(UserType::class, $user);

        $edituserForm->remove('plainPassword');

        $edituserForm->handleRequest($request);

        if ($edituserForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Utilisateur modifié avec succès !');

            return $this->redirectToRoute('app_adminuser_index');
        }

        return  $this->render('AppBundle:AdminUser:userUpdate.html.twig', [
            'user' => $user,
            'edituserForm' => $edituserForm->createView(),
        ]);
	}

  /**
   * @Route("/list")
   */
  public function listUserAction()
  {
      $em = $this->getDoctrine()->getManager();
      $users = $em->getRepository(User::class)->findBy(['roles' => 'ROLE_USER'], ['username' => 'asc']);

      return $this->render('AppBundle:AdminUser:userList.html.twig', [
        'users' => $users,
      ]);
  }
}
