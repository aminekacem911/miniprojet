<?php
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\livre;
use AppBundle\Entity\author;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
class livreController extends FOSRestController
{
  
    /**
    * @Rest\Post("/livres")
    */
    public function addbook(Request $request)
    {

        $data = new livre();
        $titre = $request->get('titre');
        $descriptif = $request->get('descriptif');
        $ISBN= $request->get('ISBN');
        $data->setTitre($titre);
        $data->setDescriptif($descriptif);
        $data->setISBN($ISBN);
        $data->setDateEdition(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("book Added Successfully !!!", Response::HTTP_CREATED);
        //works
    }
    /**
    * @Rest\Put("/livres/{id}")
    */
    public function updatebook(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(livre::class);
        $data = $repo->find($id);
        if($data == null)
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_CREATED);
        }
        $titre = $request->get('titre');
        $descriptif = $request->get('descriptif');
        $iSBN= $request->get('iSBN');
        $data->setTitre($titre);
        $data->setDescriptif($descriptif);
        $data->setISBN($iSBN);
        $data->setDateEdition(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Successfully updated !!!", Response::HTTP_ACCEPTED);
        //works
    }
    /**
    * @Rest\Get("/livres")
    */
    public function getAction()
    {
    $result = $this->getDoctrine()->getRepository(livre::class)->findAll();
    if ($result === null) 
        return new View("404!!!!", Response::HTTP_NOT_FOUND);
    return $result;

    }
    /**
    * @Rest\Get("/livre/{titre}")
    */
    public function searchAction($titre)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(livre::class);
        $result = $repo->findOneByTitre($titre);
        if ($result === null) 
            {return new View("Error while searching!!! ", Response::HTTP_NOT_FOUND);}
        return $result;
        //workks
    }
    /**
    * @Rest\Get("/livres/{id}")
    */
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(livre::class);
        $result = $repo->find($id);
        if ($result === null) 
            {return new View("not found recheck plzz !!!", Response::HTTP_NOT_FOUND);}
        return $result;
        //workks
    }
 //I DIDNT UNDERSTAND IT CUZ IT TOLD "TO Make sure annotations are installed and enabled" ITRIED TO RECOMPOSER SensioFrameworkExtraBundle BUT NO RESULT I NEED IT 
     /**
     * @Rest\Delete("/livres/{id}")
     */

  //  public function delAction(Request $request, $id)
  //  {

   //     $em = $this->getDoctrine()->getManager();
   //     $book = $em->getRepository(livre::class)->find($id);
   //     $em->remove($book);
   //     $em->flush();
//
   //     return new View(" Successfully Deleted !!!", Response::HTTP_ACCEPTED);
//
   // }




     
   
}