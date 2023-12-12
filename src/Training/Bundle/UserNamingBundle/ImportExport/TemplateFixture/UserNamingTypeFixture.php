<?php

namespace Training\Bundle\UserNamingBundle\ImportExport\TemplateFixture;

use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;

class UserNamingTypeFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    protected function createEntity($key): UserNamingType
    {
        return new UserNamingType($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return UserNamingType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): \Iterator
    {
        return $this->getEntityData('Official');
    }

    /**
     * {@inheritDoc}
     */
    public function fillEntityData($key, $entity): void
    {
        $entity->setId(1);
        $entity->setTitle('Official');
        $entity->setFormat('PREFIX FIRST MIDDLE LAST SUFFIX');
    }
}
