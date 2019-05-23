<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\WS\WSService;

class WSServiceController extends AbstractController {
    /**
    * @Route("/soap")
    */
    public function index(WSService $helloService) {
        $soapServer = new \SoapServer('../www/products.wsdl');
        $soapServer->setObject($helloService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }


    /**
     * @Route("/test")
     */
    public function test(EntityManagerInterface $em){
        dd($em->getRepository(Article::class)->findAll());
    }
}

?>