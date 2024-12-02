<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController
{
    #[Route('/')]
    public function letsgo(): Response
    {
        return new Response("Party!");
    }

    #[Route('/show/{slug}')]
    public function show(string $slug = null) : Response
    {
        if($slug) {
//            $slug = str_replace("_", " ", $slug);
//            $slug = ucwords($slug);
            $title = ucwords(str_replace('_', ' ', $slug));
            return new Response("zeige uns $title");

        } else {
            return new Response("zeige uns alle Partys!");
        }
    }
}