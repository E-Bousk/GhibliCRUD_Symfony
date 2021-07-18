<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnimController extends AbstractController
{

    /**
     * @route("/anims", name="anim.index")
     */
    public function index() :Response
    {
        return $this->render('/anim/index.html.twig', [
            'current_menu' => 'list_anim'
         ]);
    }







}