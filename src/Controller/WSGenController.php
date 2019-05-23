<?php

namespace App\Controller;

use App\Entity\CommandDetails;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\WS\WSService;
use Zend\Soap\AutoDiscover;

class WSGenController extends AbstractController {

    /**
     * @Route("/helloWSGen")
     */
    public function helloWSGenAction() {
        $autodiscover = new AutoDiscover();
        $autodiscover->setClass('App\WS\WSService')
            ->setUri('http://localhost:8000/soap');
        header('Content-Type: application/wsdl+xml');
        $wsdl = $autodiscover->generate();
        $wsdl->dump("../www/products.wsdl");

        return new Response($wsdl->toXML());
    }
}

?>