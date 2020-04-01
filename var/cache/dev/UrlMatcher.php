<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\UsuariosController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\UsuariosController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'new_Usuario', '_controller' => 'App\\Controller\\UsuariosController::registro'], null, null, null, false, false, null]],
        '/usuario/update' => [[['_route' => 'update_usuario', '_controller' => 'App\\Controller\\UsuariosController::editar'], null, null, null, false, false, null]],
        '/usuario/delete' => [[['_route' => 'delete_usuario', '_controller' => 'App\\Controller\\UsuariosController::delete'], null, null, null, false, false, null]],
        '/usuario/getdetalles' => [[['_route' => 'get_detalles', '_controller' => 'App\\Controller\\UsuariosController::getdetalles'], null, null, null, false, false, null]],
        '/imagen' => [[['_route' => 'imagen', '_controller' => 'App\\Controller\\UsuariosController::uploadSingleImage'], null, null, null, false, false, null]],
        '/seleccionpersonaje' => [[['_route' => 'prejoin', '_controller' => 'App\\Controller\\PersonajesController::seleccionpersonaje'], null, null, null, false, false, null]],
        '/personajeplantillas' => [[['_route' => 'personaje', '_controller' => 'App\\Controller\\PersonajesPlantillasController::personajeplantillas'], null, null, null, false, false, null]],
        '/getplantilla' => [[['_route' => 'personajeplantilla', '_controller' => 'App\\Controller\\PersonajesPlantillasController::getplantilla'], null, null, null, false, false, null]],
        '/newpersonaje' => [[['_route' => 'personajenew', '_controller' => 'App\\Controller\\PersonajesController::newpersonaje'], null, null, null, false, false, null]],
        '/detallespersonajes' => [[['_route' => 'detallespersonajes', '_controller' => 'App\\Controller\\PersonajesController::detallespersonajes'], null, null, null, false, false, null]],
        '/crearclase' => [[['_route' => 'crearclase', '_controller' => 'App\\Controller\\PersonajesPlantillasController::crearclase'], null, null, null, false, false, null]],
        '/tap' => [[['_route' => 'tap', '_controller' => 'App\\Controller\\PersonajesController::tap'], null, null, null, false, false, null]],
        '/reward' => [[['_route' => 'reward', '_controller' => 'App\\Controller\\PersonajesController::reward'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
    ],
    [ // $dynamicRoutes
    ],
    null, // $checkCondition
];
