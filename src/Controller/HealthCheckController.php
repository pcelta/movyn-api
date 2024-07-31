<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractController {

  #[Route('/health-check', name: 'health_check_index')]
  public function index(): JsonResponse
  {
      return new JsonResponse(['message' => 'Movyn API is up and running! Let\'s roll!']);
  }
}
