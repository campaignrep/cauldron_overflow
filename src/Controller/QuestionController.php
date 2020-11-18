<?php

// src/Controller/QuestionController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
{

    /**
     * @Route("/")
     */
    public function homepage()
    {
        return new Response('What a bewithcing controller we have whipped up here!');
    }

    /**
     * @Route("/questions/{slug}")
     */
    public function show($slug)
    {
        return new Response(sprintf(
            'This is the URL Title Maybe: %s', 
            ucwords(str_replace('-', ' ', $slug))
        ));
    }
}
