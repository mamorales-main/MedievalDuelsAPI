<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'App\Service\JwtAuth' shared autowired service.

include_once $this->targetDirs[3].'/src/Service/JwtAuth.php';

return $this->services['App\\Service\\JwtAuth'] = new \App\Service\JwtAuth(($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php')));