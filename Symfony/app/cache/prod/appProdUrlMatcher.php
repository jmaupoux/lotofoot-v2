<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // _root
        if ($pathinfo === '/^/$') {
            return array (  '_controller' => 'Lotofootv2\\Bundle\\Controller\\RootController::indexAction',  '_route' => '_root',);
        }

        if (0 === strpos($pathinfo, '/login')) {
            // _login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'Lotofootv2\\Bundle\\Controller\\LoginController::indexAction',  '_route' => '_login',);
            }

            // _login_check
            if ($pathinfo === '/login_check') {
                return array('_route' => '_login_check');
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
