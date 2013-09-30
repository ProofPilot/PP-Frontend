<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

/**
 * This file is part of the LuneticsLocaleBundle package.
*
* <https://github.com/lunetics/LocaleBundle/>
*
* For the full copyright and license information, please view the LICENSE
* file that is distributed with this source code.
*/
namespace Cyclogram\FrontendBundle\Controller;


use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\Container;

use Lunetics\LocaleBundle\Validator\MetaValidator;

/**
 * Controller for the Switch Locale
 *
 * @author Matthias Breddin <mb@lunetics.com>
 * @author Christophe Willemsen <willemsen.christophe@gmail.com>
 */
class LocaleController
{
    private $router;
    private $metaValidator;
    private $useReferrer;
    private $redirectToRoute;
    protected $container;

    /**
     * @param RouterInterface $router          Router Service
     * @param MetaValidator   $metaValidator   MetaValidator for locales
     * @param bool            $useReferrer     From Config
     * @param null            $redirectToRoute From Config
     * @param string          $statusCode      From Config
     */
    public function __construct(RouterInterface $router = null, MetaValidator $metaValidator, $useReferrer = true, $redirectToRoute = null, $statusCode = '302', Container $container)
    {
        $this->router = $router;
        $this->metaValidator = $metaValidator;
        $this->useReferrer = $useReferrer;
        $this->redirectToRoute = $redirectToRoute;
        $this->statusCode = $statusCode;
        $this->container = $container;
    }

    /**
     * Action for locale switch
     *
     * @param Request $request
     *
     * @throws \InvalidArgumentException
     * @return RedirectResponse
     */
    public function switchAction(Request $request)
    {
        $_locale = $request->attributes->get('_locale', $request->getLocale());
        $studyUrl = $request->get('study');
        if(empty($studyUrl)) {
            $branding = $this->container->getParameter('branding');
            if ($branding == 'knowathome')
                $studyUrl = "knowathome";
            else
                $studyUrl = "sexpro";
        }
        $statusCode = $request->attributes->get('statusCode', $this->statusCode);
        $useReferrer = $request->attributes->get('useReferrer', $this->useReferrer);
        $redirectToRoute = $request->attributes->get('route', $this->redirectToRoute);
        
        $queryParameters = $request->query->all();

        $routeParameters = array_merge(
                $queryParameters,  
                array(
                     "studyUrl" => $studyUrl
                ));

        $metaValidator = $this->metaValidator;
        if (!$metaValidator->isAllowed($_locale)) {
            throw new \InvalidArgumentException(sprintf('Not allowed to switch to locale %s', $_locale));
        }

        // Redirect the User
        if ($useReferrer && $request->headers->has('referer')) {
            $response = new RedirectResponse($request->headers->get('referer'), $statusCode);
        } elseif ($this->router && $redirectToRoute) {
            $routeParameters = array_merge($routeParameters, array('_locale' => $_locale));
            $response = new RedirectResponse($this->router->generate($redirectToRoute, $routeParameters), $statusCode);
        } else {
            // TODO: this seems broken, as it will not handle if the site runs in a subdir
            // TODO: also it doesn't handle the locale at all and can therefore lead to an infinite redirect
            $response = new RedirectResponse($request->getScheme() . '://' . $request->getHttpHost() . '/', $statusCode);
        }

        return $response;

    }
}
