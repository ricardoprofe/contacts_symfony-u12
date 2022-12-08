<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ContactData;

class ContactsController extends AbstractController
{
    #[Route('/contact/{id<\d+>}', name: 'app_contacts')]
    public function index($id=''): Response
    {
        //Search the contact in the array
        $contacts = ContactData::getContacts();
        $contact = Array();
        foreach ($contacts as $c){
            if($c['id'] == $id) {
                $contact = $c;
            }
        }

        //Check if we have an id and a contact
        if(empty($id) ){
            $content="<h2>Please, enter a contact Id</h2>";
        } elseif (empty($contact)) {
            $content="<h2>No contact found with id $id </h2>";
        } else {
            $phones = ContactData::getPhones();
            //We need only the phone of a single contact
            $contactsPhones ="";
            foreach ($phones as $phone) {
                if($phone['idContact']==$id){
                    $contactsPhones .= "<li> {$phone['type']}: {$phone['number']} </li>\n";
                }
            }
            $content = <<<HTML
<h2>Contact: {$contact['title']} {$contact['name']} {$contact['surname']}</h2>
    <ul>
        <li><strong>Birth date:</strong> {$contact['birthdate']}</li>
        <li><strong>Email:</strong> {$contact['email']}</li>
        <li><strong>Phones:</strong>
            <ul>
                $contactsPhones
            </ul>
        </li>
       </ul>
HTML;
        }

        //Generate the content
        $page = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Contacts App</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="/css/style.css">
</head>
<body>    
    <h1 class="centered">My Contacts App</h1>  
HTML;
        $page .= $content . "</body></html>";

        return new Response($page);
    }
}
