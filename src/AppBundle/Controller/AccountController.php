<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Car;
use AppBundle\Entity\Maintenance;
use AppBundle\Form\CarType;
use AppBundle\Form\MaintenanceType;

/**
* @Route("/compte")
* @Security("has_role('ROLE_USER')")
*/
class AccountController extends Controller
{
    /**
    * @Route("/")
    */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $cars = $user->getCars();

        $car = new Car();

        $formCar = $this->createForm(new CarType(),$car);
        $formCar->handleRequest($request);

        if ($formCar->isValid()) {
            $car->setUuid();

            $car->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('app_account_index');
        }

        return  $this->render('AppBundle:Account:index.html.twig', [
            'formCar' => $formCar->createView(),
            'cars' => $cars
        ]);
    }

    /**
    * Update
    *
    * @param Request $request Request
    * @param Car   $car   Car
    *
    * @return Response
    * @Route("/{id}/car", requirements={"id":"\d+"})
    * @Method("GET|POST")
    *
    */
    public function carupdateAction(Request $request, Car $car)
    {
        $maintenance = new Maintenance();
        $maintenanceForm = $this->createForm(MaintenanceType::class, $maintenance);

        $carForm = $this->createForm(CarType::class, $car);

        $carForm->handleRequest($request);

        if ($carForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('warning', 'Voiture modifié avec succès !');

            return $this->redirectToRoute('app_account_index');
        }

        $maintenanceForm->handleRequest($request);

        if ($maintenanceForm->isValid()) {
            $car->setUuid();

            $maintenance->setCar($car);
            $em = $this->getDoctrine()->getManager();
            $em->persist($maintenance);
            $em->flush();

            return $this->redirectToRoute('app_account_carupdate', array('id' => $car->getId()));
        }

        return  $this->render('AppBundle:Account:carUpdate.html.twig', [
            'car' => $car,
            'carForm' => $carForm->createView(),
            'maintenanceForm' => $maintenanceForm->createView(),
        ]);
    }

    /**
    * Delete
    *
    * @param Request $request Request
    * @param Maintenance   $maintenance   Maintenance
    *
    * @return Response
    * @Route("/{id}/{idCar}/supprimer-maitenance", requirements={"id":"\d+"})
    * @Method("GET")
    */
    public function maintenancedeleteAction(Request $request, Maintenance $maintenance, $idCar)
    {
        if (null === $token = $request->query->get('_token')) {
            throw $this->createAccessDeniedException('Token missing');
        }

        if (!$this->isCsrfTokenValid('DELETE_MAINTENANCE_TOKEN', $token)) {
            throw $this->createAccessDeniedException('Invalid token');
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($maintenance);

        $em->flush();

        $this->addFlash('Success', 'Voiture supprimé avec succès !');

        return $this->redirectToRoute('app_account_carupdate', array('id' => $idCar));
    }

    /**
    * Delete
    *
    * @param Request $request Request
    * @param Car   $car   Car
    *
    * @return Response
    * @Route("/{id}/supprimer", requirements={"id":"\d+"})
    * @Method("GET")
    *
    * METHOD = GET ou POST
    */
    public function cardeleteAction(Request $request, Car $car)
    {
        if (null === $token = $request->query->get('_token')) {
            throw $this->createAccessDeniedException('Token missing');
        }

        if (!$this->isCsrfTokenValid('DELETE_CAR_TOKEN', $token)) {
            throw $this->createAccessDeniedException('Invalid token');
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($car);

        $em->flush();

        $this->addFlash('Success', 'Voiture supprimé avec succès !');

        return $this->redirectToRoute('app_account_index');
    }
}
