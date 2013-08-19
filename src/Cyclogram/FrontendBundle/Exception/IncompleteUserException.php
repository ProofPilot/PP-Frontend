<?php
namespace Cyclogram\FrontendBundle\Exception;

use HWI\Bundle\OAuthBundle\Security\Core\Authentication\Token\OAuthToken;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\OAuthAwareExceptionInterface;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class IncompleteUserException extends AuthenticationException implements OAuthAwareExceptionInterface
{
    /**
     * 
     * @var string
     */
    protected $resourceOwnerName;
    
    /**
     * @var OAuthToken
     */
    protected $token;
    
    /**
     * 
     * @var int
     */
    protected $participantId;
    

    /**
     * {@inheritdoc}
     */
    public function getAccessToken()
    {
        return $this->token->getAccessToken();
    }
    
    /**
     * @return OAuthToken
     */
    public function getRawToken()
    {
        return $this->token->getRawToken();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRefreshToken()
    {
        return $this->token->getRefreshToken();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getExpiresIn()
    {
        return $this->token->getExpiresIn();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTokenSecret()
    {
        return $this->token->getTokenSecret();
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceOwnerName()
    {
        return $this->resourceOwnerName;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setResourceOwnerName($resourceOwnerName)
    {
        $this->resourceOwnerName = $resourceOwnerName;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array(
                $this->participantId,
                $this->token,
                $this->resourceOwnerName,
                parent::serialize(),
        ));
    }
    
    public function unserialize($str)
    {
        list(
                $this->participantId,
                $this->token,
                $this->resourceOwnerName,
                $parentData
        ) = unserialize($str);
        parent::unserialize($parentData);
    }


    public function getParticipantId()
    {
        return $this->participantId;
    }

    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
    }


    public function getToken()
    {
        return $this->token;
    }
}

