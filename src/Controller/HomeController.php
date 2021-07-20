<?php

namespace App\Controller;

use App\Repository\AnimRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @route("/", name="home")
     * @param AnimRepository $repository
     * @return Response
     */
    public function index(AnimRepository $repository): Response
    {
        $anims= $repository->findlatest();
        return $this->render('/pages/home.html.twig', [
            'anims' => $anims
        ]);
    }


}