<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\author;
use AppBundle\Entity\livre;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
class authorController extends FOSRestController
{
  
   
    /**
    * @Rest\Post("/authors")
    */
    public function addAuthor(Request $request)
    {
       
        $nom = $request->get('fullName');
        $email = $request->get('email');
        $data = new author();
        $data->setFullName($nom);
        $data->setEmail($email);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Successfully added !!!", Response::HTTP_CREATED);
        //works
    }
      /**
    * @Rest\Get("/authors")
    */
    public function getAction()
    {
    $result = $this->getDoctrine()->getRepository(author::class)->findAll();
    if ($result === null) 
        return new View("there are no authors", Response::HTTP_NOT_FOUND);
    return $result;
    //works
    }

    /**
    * @Rest\Put("/authors/{id}")
    */
    public function updateAuthor(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(author::class);
        $data = $repo->find($id);
        if($data == null)
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_CREATED);
        }
        $nom = $request->get('fullName');
        $email = $request->get('email');
        $data->setFullName($nom);
        $data->setEmail($email);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Successfully updated !!!", Response::HTTP_CREATED);
        //works
    }
    
    /**
    * @Rest\Get("/authors/{id}")
    */
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(author::class);
        $result = $repo->find($id);
        if ($result === null) 
            {return new View("recheck plzzz !!!", Response::HTTP_NOT_FOUND);}
        return $result;
        //works
    }
    
   /**
    * @Rest\DELETE("/authors/{id}")
    * I DIDNT UNDERSTAND IT CUZ IT TOLD "TO Make sure annotations are installed and enabled" ITRIED TO RECOMPOSER SensioFrameworkExtraBundle BUT NO RESULT I NEED IT 
    */
}