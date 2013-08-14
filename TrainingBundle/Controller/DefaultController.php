<?php

namespace Sensio\TrainingBundle\Controller;

use Sensio\TrainingBundle\Converter\CelsiusConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session;

/**
 * Class DefaultController
 * @package Sensio\TrainingBundle\Controller
 */
class DefaultController extends Controller
{

    /**
     * @Route("/hello/{name}", name="greet")
     * @Template()
     */
    public function indexAction($name)
    {
        $expires = new \DateTime('+30 days');

        $cookie = new Cookie('username', $name, $expires);
        $response = $this->redirect($this->generateUrl('hello'));
        $response->headers->setCookie($cookie);

        return $response;
    }

    /**
     * @Route("/hello", name="hello")
     * @Template()
     */
    public function helloAction(Request $request)
    {
        if (!$name = $request->cookies->get('username')) {
            throw $this->createNotFoundException('Your username is not found');
        }

        return array('name' => $name);

    }

    /**
     * @Route("/session/hello/{name}", name="session_greet")
     * @Template()
     */
    public function sessionIndexAction(Request $request)
    {
        $name = $request->attributes->get('name');

        $session = $request->getSession();
        $session->set('username', $name);

        $response = $this->redirect($this->generateUrl('session_hello'));


        return $response;
    }

    /**
     * @Route("/session/hello", name="session_hello")
     * @Template("SensioTrainingBundle:Default:hello.html.twig")
     */
    public function sessionHelloAction(Request $request)
    {
        if (!$name = $request->getSession()->get('username')) {
            throw $this->createNotFoundException('Your username is not found');
        }

        return array('name' => $name);

    }

    public function counterAction()
    {
        $counter = rand(0, 9999);
        return new Response('People online: ' . $counter);
    }

    /**
     * @Template("SensioTrainingBundle:Default:comments.html.twig")
     */
    public function commentsAction()
    {
        $comments = array(
            'THis is a commen',
            'Another cmment'
        );
        return $comments;
    }



    /**
     * @Route("/convert/{celsius}/fahreneit.{_format}",
     *      requirements={
     *          "celsius"="\d+",
     *          "_format"="xml|json"
     *      }
     * )
     * @Template()
     */
    public function celsiusAction($celsius)
    {
        $converter = new CelsiusConverter($celsius);

        return array(
            'fahrenheit' => $converter->toFahrenheit(),
            'celsius' => $converter->getValue()
        );

    }
}
