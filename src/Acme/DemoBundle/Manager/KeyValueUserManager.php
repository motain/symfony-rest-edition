<?php

namespace Acme\DemoBundle\Manager;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Key/value user manager for the FOSUserBundle
 *
 * @author Dirk Pahl <dirk.pahl@motain.de>
 * @since  0.0.1
 *
 * created 13.06.13 11:00
 */
class KeyValueUserManager extends BaseUserManager
{
    /**
     * @var string
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param CanonicalizerInterface  $usernameCanonicalizer
     * @param CanonicalizerInterface  $objectKeyValueMapper
     * @param ObjectKeyValueMapper    $om
     * @param string                  $class
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $usernameCanonicalizer, CanonicalizerInterface $emailCanonicalizer, $class)
    {
        parent::__construct($encoderFactory, $usernameCanonicalizer, $emailCanonicalizer);

        $this->class = $class;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteUser(UserInterface $user)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritDoc}
     */
    public function findUserBy(array $criteria)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function findUsers()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function reloadUser(UserInterface $user)
    {
    }

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     * @param Boolean       $andFlush Whether to flush the changes (default true)
     */
    public function updateUser(UserInterface $user, $andFlush = true)
    {
    }
}
