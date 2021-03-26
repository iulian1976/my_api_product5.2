<?php

namespace App\DataPersister;

use App\Entity\Product;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ArticleDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */

    private $entityManager;

    /**
     * @param Request
     */
    private $request;


    public function __construct(EntityManagerInterface $entityManager,RequestStack $request) {
        $this->entityManager = $entityManager;
        $this->request = $$request;
    }

    /**
    * {@inheritdoc}
    */

    public function supports($data, array $context = []): bool
    {
        $data instanceof Product;
    }

    /**
     * @param Product $data
     */

    public function persist($data, array $context = [])
    {
        if ($this->request->getMethod() == 'GET') {
            $data->setId( md5( $data->getId()));
            $this->entityManager->persist($data);
            $this->entityManager->flush();
        }


    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}