<?php


namespace App\Controller;

use App\Service\Ayuda;
use App\Service\JwtAuth;
use App\Entity\Usuarios;
use App\Entity\UsuariosDetalles;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;

class UsuariosController extends Controller
{
    public function registro(JwtAuth $jwtAuth,Request $request, Ayuda $helpers)
    {
        //controlador recibe parámetros de la request URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $password = isset($params->password) ? $params->password : null;
            $nombre = isset($params->nombre) ? $params->nombre : null;
            $apellidos = isset($params->apellidos) ? $params->apellidos : null;
            $pais = isset($params->pais) ? $params->pais : null;
            $telefono = isset($params->telefono) ? $params->telefono : null;
            $getHash = isset($params->getHash) ? $params->getHash : null;

            //controlador invoca al MODELO
            $em = $this->getDoctrine();
            $user = $em->getRepository(Usuarios::class)->new($login,$password);
            $userD = $em->getRepository(UsuariosDetalles::class)->new($login,$nombre,$apellidos,$pais,$telefono);

            if ($user != null) {
                $datosUser = $em->getRepository(Usuarios::class)
                    ->findOneBy( array(
                        "login" => $login,
                        "password" => $password
                    ));
                $detallesUser = $em->getRepository(UsuariosDetalles::class)
                    ->findOneBy( array(
                        "login" => $login
                    ));
                $data = array(
                    'status' => 'success',
                    'token' => $jwtAuth->signup($login, $password, true),
                    'user' => $detallesUser
                );
                return $helpers->aJson($data);
            }else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'Datos incorrectos.'
                    ));
            }
        }
    }




    public function login(Request $request, JwtAuth $jwtAuth, Ayuda $helpers) {

        $dataJson = $request->get('data', null);
        if ($dataJson != null){
            $params= json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $password = isset($params->password) ? $params->password : null;
            $getHash = isset($params->getHash) ? $params->getHash : null;

            $em = $this->getDoctrine();
            $user = $em->getRepository(Usuarios::class)
                ->findOneBy( array(
                    "login" => $login,
                    "password" => $password
                ));
            $userD = $em->getRepository(UsuariosDetalles::class)
                ->findOneBy( array(
                    "login" => $login
                ));

            if (is_object($user)){
                $data = array(
                    'status' => 'success',
                    'token' => $jwtAuth->signup($login, $password, true),
                    'user' => $userD
                );

                return $helpers->aJson($data);
            }else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'El nombre de usuario o contraseña es incorrecto.'
                    ));
            }

        }else {
            $data = array(
                'status' => 'error',
                'data' => 'parametros erróneos'
            );
            return $helpers->aJson($data);
        }
    }

    public function getdetalles(Request $request, JwtAuth $jwtAuth, Ayuda $helpers) {
        $dataJson = $request->get('data', null);
        if ($dataJson != null){
            $params= json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $token = isset($params->token) ? $params->token : null;
            $auth = $jwtAuth->checkToken($token, false);
            $em = $this->getDoctrine();

            if ($auth==true) {
                $detallesusuario = $em->getRepository(UsuariosDetalles::class)
                    ->findOneBy( array(
                        "login" => $login
                    ));

                if (is_object($detallesusuario)){
                    $data = array(
                        'status' => 'success',
                        'detallesusuario' => $detallesusuario
                    );

                    return $helpers->aJson($data);
                }else {
                    return $helpers->aJson(
                        array(
                            'status' => 'error',
                            'data' => 'Detalles de personajes vacío.'
                        ));
                }
            }else {
                $data = array(
                    'status' => 'error',
                    'data' => 'Token erróneo'
                );
                return $helpers->aJson($data);
        }
        }

    }

    public function editar(Request $request, Ayuda $helpers, JwtAuth $jwtAuth,EntityManagerInterface $emm){
        //controlador recibe parámetros de la request URL
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $password = isset($params->password) ? $params->password : null;
            $nombre = isset($params->nombre) ? $params->nombre : null;
            $apellidos = isset($params->apellidos) ? $params->apellidos : null;
            $pais = isset($params->pais) ? $params->pais : null;
            $telefono = isset($params->telefono) ? $params->telefono : null;
            $token = isset($params->token) ? $params->token : null;
            $auth = $jwtAuth->checkToken($token, false);
            $em = $this->getDoctrine();

            if ($auth==true) {
                $user = $em->getRepository(Usuarios::class)->find($login);
                $userD = $em->getRepository(UsuariosDetalles::class)->find($login);
                $user->setPassword($password);
                $userD->setNombre($nombre);
                $userD->setApellidos($apellidos);
                $userD->setTelefono($telefono);
                $userD->setPais($pais);
                $emm->flush();
                return $helpers->aJson( array(
                    'status' => 'success'
                ));
            }else {
                $data = array(
                    'status' => 'error',
                    'data' => 'Token erróneo' );
                return $helpers->aJson($data); }
            }
            else {
                return $helpers->aJson(
                    array(
                        'status' => 'error',
                        'data' => 'Datos incorrectos.'
                    ));
            }
        }


    public function uploadSingleImage(Request $request,EntityManagerInterface $emm,Ayuda $helpers, JwtAuth $jwtAuth) {
        $dataJson = $request->get('data', null);
        if ($dataJson != null) {
            $params = json_decode($dataJson);
            $login = isset($params->login) ? $params->login : null;
            $base64 = isset($params->base64) ? $params->base64 : null;
            $token = isset($params->token) ? $params->token : null;
            $auth = $jwtAuth->checkToken($token, false);

            $base64 = str_replace(" ", "+", $base64);

            $uniname = uniqid() . date("Y-m-d-H-i-s") . ".jpg";
            $new_image_url = "../public/images/profile/" . $uniname;
            $base64 = 'data:image/jpeg;base64,' . $base64;
            $base64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
            file_put_contents($new_image_url, $base64);

            $em = $this->getDoctrine();
            if ($auth == true){
                $userD = $em->getRepository(UsuariosDetalles::class)->find($login);
                $userD->setImg("images/profile/" . $uniname);
                $emm->flush();
                return $helpers->aJson( array(
                    'status' => 'success'
                ));

            }else {
                $data = array(
                    'status' => 'error',
                    'data' => 'Token erróneo' );
                return $helpers->aJson($data); }


        }else {
            return $helpers->aJson(
                array(
                    'status' => 'error',
                    'data' => 'Datos incorrectos.'
                ));
        }

    }


}
