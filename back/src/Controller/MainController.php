<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpClient\HttpClient;

use App\Entity\Jugador;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController{


    /**
      * @Route("/nuevoTiempo/{nombre}/{tiempo}")
    */
    public function nuevoTiempo(string $nombre, int $tiempo): Response{


        $entityManager = $this->getDoctrine()->getManager();

        $jugador = $this->getDoctrine()
            ->getRepository(Jugador::class)
            ->findOneBy(['nombre' => $nombre]);

        if(!$jugador){

            $jugador = new Jugador();
            $jugador->setNombre($nombre);
            $jugador->setUltimoTiempo($tiempo);
            $jugador->setMejorTiempo($tiempo);

            $entityManager->persist($jugador);

            $entityManager->flush();

        }else{

            $jugador->setUltimoTiempo($tiempo);
            $entityManager->flush();

            if($tiempo < $jugador->getMejorTiempo()){

                $jugador->setMejorTiempo($tiempo);
                $entityManager->flush();

            }

        }

        $jugadores = $this->getDoctrine()->getRepository(Jugador::class)->findAll();



        $arrayJugadores = array();

        foreach($jugadores as $jugador) {
             $arrayJugadores[] = array(
                 'id' => $jugador->getId(),
                 'nombre' => $jugador->getNombre(),
                 'ultimoTiempo' => $jugador->getUltimoTiempo(),
                 'mejorTiempo' => $jugador->getMejorTiempo(),
             );
        }



        return new JsonResponse($arrayJugadores);

    }


}