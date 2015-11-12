<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function indexAction()
    {
        return new Response('Hello, World!');
    }
}
