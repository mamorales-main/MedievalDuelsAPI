<?php


namespace App\Controller;
use App\Entity\Usuarios;
use App\Entity\UsuariosDetalles;
use App\Service\Ayuda;
use App\Service\JwtAuth;
use App\Entity\Personajes;
use App\Entity\PersonajesDetalles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonajesController extends Controller
{
    public function seleccionpersonaje(Request $request, Ayuda $helpers, JwtAuth $jwtAuth)
    {
        //controlador recibe parámetros de la request URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $token = (isset($params->token)? $params->token:null);
            $auth = $jwtAuth->checkToken($token, false);
            $em = $this->getDoctrine();

            if($auth == true) {
                if ($login != null) {
                    $personajes = $em->getRepository(Personajes::class)->coger($login);
                    if ($personajes != null) {
                        $nombre = $em->getRepository(Personajes::class)->cogerN($login);
                        $data = array(
                            'status' => 'success',
                            'personajes' => $personajes
                        );
                    } else {
                        $data = array(
                            'status' => 'error'
                        );
                    }
                    return $helpers->aJson($data);
            }

            }else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'Datos incorrectos.'
                    ));
            }
        }
    }
    public function detallespersonajes(Request $request, Ayuda $helpers, JwtAuth $jwtAuth){
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $nombre = isset($params->nombre) ? $params->nombre : null;
            $token = (isset($params->token) ? $params->token : null);
            $auth = $jwtAuth->checkToken($token, false);
            $em = $this->getDoctrine();

            if ($auth == true) {
                if ($nombre != null) {
                    $detallespersonajes = $em->getRepository(PersonajesDetalles::class)->cogerD($nombre);
                    if ($detallespersonajes != null) {
                        $data = array(
                            'status' => 'success',
                            'detallespersonajes' => $detallespersonajes
                        );
                    } else {
                        $data = array(
                            'status' => 'error'
                        );
                    }
                    return $helpers->aJson($data);
                }
                } else {
                    return $helpers->aJson(
                        array(
                            'status' => 'error',
                            'data' => 'Datos incorrectos.'
                        ));
                }
            }
    }

    public function newpersonaje(Request $request, Ayuda $helpers, JwtAuth $jwtAuth)
    {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $nombre = isset($params->nombre) ? $params->nombre : null;
            $nivel = isset($params->nivel) ? $params->nivel : null;
            $clase = isset($params->clase) ? $params->clase : null;
            $fuerza = isset($params->fuerza) ? $params->fuerza : null;
            $destreza = isset($params->destreza) ? $params->destreza : null;
            $inteligencia = isset($params->inteligencia) ? $params->inteligencia : null;
            $exp = isset($params->exp) ? $params->exp : 0;
            $expreq = isset($params->expreq) ? $params->expreq : 10000;
            $saldo = isset($params->saldo) ? $params->saldo : 0;

            $token = (isset($params->token) ? $params->token : null);
            $auth = $jwtAuth->checkToken($token, false);
            $em = $this->getDoctrine();

            if ($auth == true) {
                $personaje = $em->getRepository(Personajes::class)->new($login, $nombre);
                $personajeD = $em->getRepository(PersonajesDetalles::class)->new
                ($nombre, $nivel, $clase, $fuerza, $destreza, $inteligencia, $exp, $expreq, $saldo);

                return $helpers->aJson(
                    array(
                        'status' => 'success',
                    ));
            } else {return $helpers->aJson(
                array(
                    'status' => 'session outdated',
                ));}
        } else {
            return $helpers->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }
    }

    public function tap(Request $request, Ayuda $helpers, EntityManagerInterface $emm) {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $nombre = isset($params->nombre) ? $params->nombre : null;

            $em = $this->getDoctrine();

            if ($nombre != null) {
                $personaje = $em->getRepository(PersonajesDetalles::class)->find($nombre);

                $nivel = $personaje->getNivel();
                $exp = $personaje->getExp();
                $expreq = $personaje->getExpreq();
                $saldo = $personaje->getSaldo();
                $suma = $nivel + 1;
                $subirexp = $nivel * 10 * 1.5;

                if($exp >= $expreq) {
                    $personaje->setNivel($suma);
                    $personaje->setExpreq($expreq * 2);
                    $personaje->setExp(0);
                } else {
                    $personaje->setExp($exp + $subirexp);
                    $personaje->setSaldo($saldo + 1);
                }                $emm->flush();
                return $helpers->aJson(
                    array(
                        'status' => 'success'
                    ));
            } else {return $helpers->aJson(
                array(
                    'status' => 'session outdated',
                ));}
        } else {
            return $helpers->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }
    }
    public function reward(Request $request, Ayuda $helpers, EntityManagerInterface $emm) {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $nombre = isset($params->nombre) ? $params->nombre : null;

            $em = $this->getDoctrine();

            if ($nombre != null) {
                $personaje = $em->getRepository(PersonajesDetalles::class)->find($nombre);

                $saldo = $personaje->getSaldo();

                $personaje->setSaldo($saldo + 50);
                $emm->flush();
                return $helpers->aJson(
                    array(
                        'status' => 'success'
                    ));
            } else {return $helpers->aJson(
                array(
                    'status' => 'session outdated',
                ));}
        } else {
            return $helpers->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }
    }


}
