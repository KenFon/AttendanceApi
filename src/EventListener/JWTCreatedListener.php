<?php 
namespace App\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * Replaces the data in the generated
     *
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        /** @var $user \AppBundle\Entity\User */
        $user = $event->getUser();

        // merge with existing event data
        $payload = array_merge(
            $event->getData(),
            [
                'userId' => $user->getId(),
                'fisrtname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
            ]
        );

        $event->setData($payload);
    }
}

?>