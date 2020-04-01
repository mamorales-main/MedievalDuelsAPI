<?php


namespace App\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class Ayuda
{
    public function aJson($datos) {
    //$datos --> Array complejo de Objetos

        $encoders = array("json" => new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $datosJson = $serializer->serialize($datos, 'json');

        $response = new Response();
        $response->setContent($datosJson);
        $response->headers->set("Content-Type", "application/x-www-urlencoded");
        return $response;

    }

}