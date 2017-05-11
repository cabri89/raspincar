<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stat;
use AppBundle\Entity\Car;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/api/")
*/
class ApiController extends Controller
{
    /**
    * @Route("user/")
    */
    public function showAction()
    {

        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository(Car::class)->findBy(['id' => 3]);

        $date = new \DateTime('2000-01-01');
        $stat = new Stat();
        $stat
        ->setLocalisation('Mon premier article')
        ->setConsommation('Le contenu de mon article.')
        ->setTemperature('Le contenu de mon article.')
        ->setDate($date)
        ->setCar($car[0])
        ;

        $data = $this->get('jms_serializer')->serialize($stat, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
    * @Route("addstat/")
    * @Method("POST")
    */
    public function createAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository(Car::class)->findBy(['id' => 3]);

        $date = new \DateTime('2000-01-01');
        $stat = new Stat();
        $stat
        ->setLocalisation('Mon premier article')
        ->setConsommation('Le contenu de mon article.')
        ->setTemperature('Le contenu de mon article.')
        ->setDate($date)
        ->setCar($car[0])
        ;


        $data = $request->getContent();
        $test = $this->get('jms_serializer')->deserialize($data, 'AppBundle\Entity\Stat', 'json');
var_dump($test);
        $em = $this->getDoctrine()->getManager();
        $em->persist($stat);
        $em->flush();

        return new Response($test, Response::HTTP_CREATED);
    }
}
