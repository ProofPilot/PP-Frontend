<?php
namespace Cyclogram\FrontendBundle\Listener;

use Cyclogram\Bundle\ProofPilotBundle\Entity\Participant;

use Symfony\Component\Routing\RouterInterface;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\DependencyInjection\Container;
use Cyclogram\ProofPilotBundle\Entity\User;

class SecurityListener
{
    /**
     * @var Router $router
     */
    private $router;
    
    /**
     * @var SecurityContext $security
     */
    private $security;
    
    /**
     * @var Container $container
     */
    private $container;
    
    /**
     * @var boolean $redirectToAdmin
     */
    private $isRepresentive = false;
    private $user = '';
    private $roles = array();
    
    /**
     * Constructs a new instance of SecurityListener.
     *
     * @param Router $router The router
     * @param SecurityContext $security The security context
     */
    public function __construct(RouterInterface $router, SecurityContext $security, Container $container)
    {
        $this->router = $router;
        $this->security = $security;
        $this->container = $container;
    }
    
    /**
     * Invoked after a successful login.
     *
     * @param InteractiveLoginEvent $event The event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->user = $this->security->getToken()->getUser();
    }
    
    /**
     * Invoked after the response has been created.
     *
     * @param FilterResponseEvent $event The event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getResponse()->headers->set('x-frame-options', 'SAMEORIGIN');
        
        
        if (!empty($this->user) ) {
            
            $roles = $this->user->getRoles();

            foreach ($roles as $role){
                if ($role == 'FACEBOOK_REGISTERED')
                    $event->setResponse(new RedirectResponse($this->router->generate('_do_login')));
                if ($role == 'FACEBOOK_NOT_REGISTERED') {
                    $this->container->get('security.context')->setToken(null);
                    $this->container->get('request')->getSession()->invalidate();
                    $event->setResponse(new RedirectResponse($this->router->generate('_registration')));
                }
                if ($role == 'FACEBOOK_REGISTRATION_PROCESS') {
                    //if user is trying to register through Facebook login, we redirect
                    if($this->user instanceof Participant) {
                        $mobile = $this->user->getParticipantMobileNumber();
                        if($mobile) {
                            $id = $this->user->getParticipantId();
                            $country_code = substr($mobile, 0, 1);
                            $phone = substr($mobile, 1);
                            $redirectUrl = $this->router->generate('reg_step_2', array('country_code' => $country_code,'phone' => $phone, 'id' => $id));
                        } else {
                            $id = $this->user->getParticipantId();
                            $redirectUrl = $this->router->generate('reg_step_2', array('id' => $id));
                        }
                    }
                    $event->setResponse(new RedirectResponse($redirectUrl));
                }
            }
            
        }
    }
}
