<?php

namespace App\WS;

use App\Entity\Article;
use App\Entity\CommandDetails;
use App\Repository\CommandDetailsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Array_;

class WSService {

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @param string $name
     * @return string hello
     */
    public function hello($name){
        return 'Hello !';
    }

    /**
     * @return array bestSellers
     */
    public function getBestSellers() {

        $repository = $this->em->getRepository(CommandDetails::class);

        $bestSellers = $repository->findBestSeller();

        return $bestSellers;
    }

    /**
     * @param int $id
     * @return App\Entity\Article article
     */
    public function getArticle($id = 1) {

        $repository = $this->em->getRepository(CommandDetails::class);

        $article = $repository->find($id);

        return $article;
    }
}

?>