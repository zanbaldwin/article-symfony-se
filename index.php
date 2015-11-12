<?php
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\TerminableInterface;

$loader = require_once __DIR__ . '/vendor/autoload.php';
// Annotations are not classes! Composer will *not* resolve and autoload class names inside annotation, so we *must*
// register Composer's autoloading functionality with the annotations registry!
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$env = new Dotenv\Dotenv(__DIR__ . '/app');
$env->load();
$env->required(['SYMFONY_ENV', 'SYMFONY_DEBUG']);

$kernel = new Application(getenv('SYMFONY_ENV'), $debug = (bool) getenv('SYMFONY_DEBUG'));
// Enable the debug component if we're in debug mode.
$debug && Debug::enable();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel instanceof TerminableInterface && $kernel->terminate($request, $response);
