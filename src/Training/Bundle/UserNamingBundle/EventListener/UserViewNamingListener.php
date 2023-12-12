<?php

namespace Training\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UserBundle\Entity\User;
use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserViewNamingListener
{
    /**
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(private AuthorizationCheckerInterface $authorizationChecker)
    {
    }

    /**
     * @param BeforeListRenderEvent $event
     *
     * @return void
     */
    public function onUserView(BeforeListRenderEvent $event): void
    {
        if (!$this->authorizationChecker->isGranted('training_user_naming_info')) {
            return;
        }

        $user = $event->getEntity();
        if (!$user instanceof User) {
            return;
        }

        $template = $event->getEnvironment()->render(
            '@TrainingUserNaming/User/userNameBlock.html.twig',
            ['entity' => $user]
        );

        $subBlockId = $event->getScrollData()->addSubBlock(0);
        $event->getScrollData()->addSubBlockData(0, $subBlockId, $template);
    }
}
