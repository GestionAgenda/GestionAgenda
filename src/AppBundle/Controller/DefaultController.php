<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
 * @Route("/", name="homepage")
 */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'user' => $this->getUser(),
        ]);
    }
    /**
     * @Route("/sign-in", name="login")
     */
    public function signInAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/sign_in.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/sign-up", name="register")
     */
    public function signUpAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/sign_up.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    /**
     * @Route("/password", name="password")
     */
    public function passwordAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/password.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
