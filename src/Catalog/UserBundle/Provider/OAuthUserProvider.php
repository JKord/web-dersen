<?php
namespace  Catalog\UserBundle\Provider;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface,
    HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;

use Symfony\Component\Security\Core\User\UserProviderInterface,
    Symfony\Component\Security\Core\User\UserInterface,
    Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;
use Catalog\UserBundle\Entity\User;

class OAuthUserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{
    protected $em,
              $userRepository;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $this->userRepository = $entityManager->getRepository('CatalogUserBundle:User');
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username)
    {
        $user = new User();
        $user
            ->setUsername($username)
            ->setRoles('ROLE_USER');

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $attr = $response->getResponse();
        switch($response->getResourceOwner()->getName()) {
            //case 'google':
            case 'vk':
                $attr = $attr['response'][0];
                if(!$user = $this->userRepository->findOneByGoogleId($attr['uid'])) {
                    /*if(($user = $this->userRepository->findByUsername($attr['first_name'].' '.$attr['last_name']))) {
                        $user->setGoogleId($attr['uid']);
                        if(!$user->getUsername()) {
                            $user->setUsername($attr['first_name'].' '.$attr['last_name']);
                        }
                    } else {*/
                        $user = new User();
                        $user
                            ->setUsername($attr['first_name'].' '.$attr['last_name'].'1')
                            ->setEmail('')
                            ->setPassword('')
                            ->setGoogleId($attr['uid'])
                            ->setRoles(array('ROLE_USER'))
                        ;
                        $this->em->persist($user);
                   // }
                }
                break;
            case 'facebook':
                if(!$user = $this->userRepository->findOneByFacebookId($attr['id'])) {
                    if(($user = $this->userRepository->findOneByEmail($attr['email'])) && $attr['verified']) {
                        $user->setFacebookId($attr['id']);
                        if(!$user->getUsername()) {
                            $user->setUsername($attr['first_name'].' '.$attr['last_name']);
                        }
                    } else {
                        $user = new User();
                        $user
                            ->setUsername($attr['first_name'].' '.$attr['last_name'])
                            ->setEmail($attr['email'])
                            ->setPassword('')
                            ->setFacebookId($attr['id'])
                            ->setRoles(array('ROLE_USER'))
                         ;
                        $this->em->persist($user);
                    }
                }
                break;
        }
        $this->em->flush();

        if (null === $user) {
            throw new AccountNotLinkedException(sprintf("User '%s' not found.", $attr['email']));
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(sprintf('Unsupported user class "%s"', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === 'Catalog\\UserBundle\\Entity\\User';
    }
}
