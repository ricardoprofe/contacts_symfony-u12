<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    #[Route('/', name: 'app_main_page')]
    public function index(): Response
    {
        $content = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Contacts App</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1 class="centered">My Contacts App</h1>
    <p  class="centered">Welcome to my Contacts App</p>
    <p  class="centered">Try to search a <a href ="/contact/">contact</a> by its id</p>
</body>
</html> 
HTML;

        return new Response($content);
    }
}
