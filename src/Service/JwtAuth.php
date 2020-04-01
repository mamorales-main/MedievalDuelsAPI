<?php


namespace App\Service;
use App\Controller\UsuariosDetallesController;
use Firebase\JWT\JWT;
use App\Entity\Usuarios;
use App\Entity\UsuariosDetalles;


class JwtAuth
{
    public $emanager;
    public $key = "mi clave secreta";
    public function __construct($manager)
    {
        $this->emanager = $manager;
    }

    public function checkToken($hash, $getIdentity = false)
    {
        // si getIdentity == true se devuelve $decoded que contiene los datos decodificados
        // si getIdentity == false se devuelve $auth que es true (si token es válido) /false (token no válido)
        $auth = false; //sup token es inválido
        try {
            $decoded = JWT::decode($hash, $this->key, array('HS256'));
        } catch (\UnexpectedValueException $e) {
            $auth = false; //token es inválido
        } catch (\DomainException $e) {
            $auth = false; //token es inválido
        }

        if (isset($decoded) && is_object($decoded) && isset($decoded->login)) {
            $auth = true; //token es correcto
        } else {
            $auth = false; //token es inválido
        }

        if ($getIdentity == false) {
            return $auth;
        } else {
            return $decoded;
        }
    }

    public function signup($login, $password, $getHash = null){

        $userD = $this->emanager->getRepository(UsuariosDetalles::class)
            ->findOneBy( array(
                "login" => $login
            ));
        $userExiste = false;
        if (is_object($userD)){ //se encuentra en la BD
            $userExiste = true;
        }
        if ($userExiste){
            $token = array(
                "login"   =>  $userD->getLogin(),
                "nombre" =>  $userD->getNombre(),
                "apellidos" =>  $userD->getApellidos(),
                "pais" =>  $userD->getPais(),
                "telefono" =>  $userD->getTelefono(),
                "time" => time(),
                "exp" => time() + (7 * 24 * 60 * 60)
            );
            $hash = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($hash, $this->key, array('HS256'));
            if ($getHash != null)
                return $hash;
            else
                return $decoded;
        }else {
            return array(
                "status" => "error",
                "msg" => "Login Failed"
            );
        }
    }
}