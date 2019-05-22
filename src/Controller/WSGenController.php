<?php

namespace App\Controller;

use App\Entity\CommandDetails;
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

        /*$WSService = new WSService($this->getDoctrine()->getManager());
        dd($WSService->getBestSellers());*/

        $repository = $this->getDoctrine()->getRepository(CommandDetails::class);

        $bestSellers = $repository->findBestSeller();

        dd($bestSellers);

        return new Response($wsdl->toXML());
    }
}

?>