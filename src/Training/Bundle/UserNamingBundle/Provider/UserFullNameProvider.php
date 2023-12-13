<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\UserBundle\Entity\User;

class UserFullNameProvider
{
    /**
     * @param User $user
     * @param string $format
     * @return string
     */
    public function getFullName(User $user, string $format): string
    {
        return strtr(
            $format,
            [
                'PREFIX' => $user->getNamePrefix(),
                'FIRST' => $user->getFirstName(),
                'MIDDLE' => $user->getMiddleName(),
                'LAST' => $user->getLastName(),
                'SUFFIX' => $user->getNameSuffix(),
            ]
        );
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFullNameExample(string $format): string
    {
        $user = new User();
        $user->setNamePrefix('Mr.')
            ->setFirstName('Max')
            ->setMiddleName('Oleksiyovich')
            ->setLastName('Max')
            ->setNameSuffix('Jr.');

        return $this->getFullName($user, $format);
    }
}
