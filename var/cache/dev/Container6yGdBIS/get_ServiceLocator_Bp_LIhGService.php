<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.bp.LIhG' shared service.

return $this->privates['.service_locator.bp.LIhG'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'helpers' => ['privates', 'App\\Service\\Ayuda', 'getAyudaService.php', true],
    'jwtAuth' => ['services', 'App\\Service\\JwtAuth', 'getJwtAuthService.php', true],
], [
    'helpers' => 'App\\Service\\Ayuda',
    'jwtAuth' => 'App\\Service\\JwtAuth',
]);
