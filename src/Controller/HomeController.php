<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $logFiles = [
            'access.log',
            'access.log.1',
            'access.log.2.gz',
            'access.log.3.gz',
            'access.log.4.gz',
            'access.log.5.gz',
            'access.log.6.gz',
            'access.log.7.gz',
            'access.log.8.gz',
            'access.log.9.gz',
            'access.log.10.gz',
            'access.log.11.gz',
            'access.log.12.gz',
            'access.log.13.gz',
            'access.log.14.gz',
        ];

        $today = new \DateTimeImmutable('today');
        $mapped = [];

        foreach ($logFiles as $file) {
            preg_match('/access\.log(?:\.([0-9]+))?/', $file, $matches);
            $dayOffset = isset($matches[1]) ? (int)$matches[1] : 0;
            $date = $today->modify("-$dayOffset days")->format('d/m/Y');
            $mapped[] = [
                'name' => $file,
                'date' => $date,
            ];
        }

        return $this->render('home/index.html.twig', [
            'logs' => $mapped,
        ]);
    }
}
