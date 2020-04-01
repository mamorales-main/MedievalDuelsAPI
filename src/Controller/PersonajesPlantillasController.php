<?php


namespace App\Controller;
use App\Entity\Personajes;
use App\Entity\PersonajesDetalles;
use App\Service\Ayuda;
use App\Entity\PersonajesPlantillas;
use App\Service\JwtAuth;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonajesPlantillasController extends Controller
{
    public function personajeplantillas(Request $request, Ayuda $helpers, JwtAuth $jwtAut)
    {
        $em = $this->getDoctrine();
        $dataJson = $request->get('data', null);

        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $token = (isset($params->token)? $params->token:null);
            $auth = $jwtAut->checkToken($token, false);

            if($auth == true) {
            $plantillas = $em->getRepository(PersonajesPlantillas::class)->findAll();
            $data = array(
                'plantillas' => $plantillas
            );
            $respuesta = $helpers->aJson($data);
            }else {
                $respuesta = $helpers->aJson(
                    array(
                        'status' => 'error',
                        'msn'=> 'Identificación no válida'
                    ));
            }
        }

        return $respuesta;
    }

    public function getplantilla(Request $request, Ayuda $helpers, JwtAuth $jwtAuth)
    {
        $em = $this->getDoctrine();
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $clase = isset($params->clase) ? $params->clase : null;
            $token = (isset($params->token)? $params->token:null);
            $auth = $jwtAuth->checkToken($token, false);

            if ($auth == true) {
                $em = $this->getDoctrine();
                $plantilla = $em->getRepository(PersonajesPlantillas::class)->cogerP($clase);
                $data = array(
                    'status' => 'success',
                    'plantillaseleccionada' => $plantilla
                );
                $respuesta = $helpers->aJson($data);
            }else {
                $respuesta = $helpers->aJson(
                    array(
                        'status' => 'error',
                        'msn'=> 'Identificación no válida'
                    ));
            }
        } else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'Datos incorrectos PREJOIN.'
                    ));
            }
        return $respuesta;

    }
    public function crearclase(Request $request, Ayuda $helpers, JwtAuth $jwtAuth)
    {
        $em = $this->getDoctrine();
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $fuerza = isset($params->fuerza) ? $params->fuerza : null;
            $destreza = isset($params->destreza) ? $params->destreza : null;
            $inteligencia = isset($params->inteligencia) ? $params->inteligencia : null;
            $clase = isset($params->clase) ? $params->clase : null;
            $token = (isset($params->token) ? $params->token:null);
            $auth = $jwtAuth->checkToken($token, false);

			$nivel = 1;
            if ($auth == true) {
                $em = $this->getDoctrine();
                $plantillacreada = $em->getRepository(PersonajesPlantillas::class)->crearP($fuerza,$destreza,$inteligencia,$nivel,$clase);
                $data = array(
                    'status' => 'success',
                    'plantillacreada' => $plantillacreada
                );
                $respuesta = $helpers->aJson($data);
            }else {
                $respuesta = $helpers->aJson(
                    array(
                        'status' => 'error',
                        'msn'=> 'Identificación no válida'
                    ));
            }
        } else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'Datos vacíos creación de personaje.'
                    ));
            }
        return $respuesta;

    }


}



