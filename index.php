<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\TerminableInterface;

require_once __DIR__ . '/vendor/autoload.php';

$env = new Dotenv\Dotenv(__DIR__ . '/app');
$env->load();
$env->required(['SYMFONY_ENV', 'SYMFONY_DEBUG']);

$kernel = new AppKernel(getenv('SYMFONY_ENV'), (bool) getenv('SYMFONY_DEBUG'));

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel instanceof TerminableInterface && $kernel->terminate($request, $response);
