<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TmpController extends AbstractController
{
    #[Route(path: '/tmp', name: 'foo', methods: ['GET'])]
    public function foo(): JsonResponse
    {
        return $this->json(
            $this->getUser()
        );
    }
}