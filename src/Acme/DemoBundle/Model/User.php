<?php

namespace Acme\DemoBundle\Model;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Base user class for using a key/value store as storage
 *
 * @ExclusionPolicy("all")
 *
 * @author Dirk Pahl <dirk.pahl@motain.de>
 * @since  0.0.1
 *
 * created 13.06.13 10:47
 */
class User extends BaseUser
{
    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $firstname;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $lastname;

    /**
     * @var string
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @Type("string")
     * @Expose
     */
    protected $email;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $emailCanonical;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $username;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $usernameCanonical;

    /**
     * @var bool
     * @Type("boolean")
     * @Expose
     */
    protected $enabled;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $salt;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $password;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Expose
     */
    protected $lastLogin;

    /**
     * @var string
     * @Type("string")
     * @Expose
     */
    protected $confirmationToken;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Expose
     */
    protected $passwordRequestedAt;

    /**
     * @var Collection
     * @Type("array")
     * @Expose
     */
    protected $groups;

    /**
     * @var boolean
     * @Type("boolean")
     * @Expose
     */
    protected $locked;

    /**
     * @var boolean
     * @Type("boolean")
     * @Expose
     */
    protected $expired;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Expose
     */
    protected $expiresAt;

    /**
     * @var array
     * @Type("array")
     * @Expose
     */
    protected $roles;

    /**
     * @var boolean
     * @Type("boolean")
     * @Expose
     */
    protected $credentialsExpired;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Expose
     */
    protected $credentialsExpireAt;

    /**
     * @var string
     */
    private $primaryHash = 'users:user';

    /**
     * @var string
     */
    private $indexHash = 'users:index:';

    /**
     * @var string
     */
    protected $facebookAccessToken;

    public function __construct()
    {
        parent::__construct();
    }

    public function serialize()
    {
        return serialize(array($this->facebookId, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookId, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get the full name of the user (first + last name)
     * @return string
     */
    public function getFullName()
    {
        return $this->getFirstName() . ' ' . $this->getLastname();
    }

    /**
     * @param string $facebookId
     * @return void
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
        $this->setUsername($facebookId);
        $this->salt = '';
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookAccessToken
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    /**
     * @param Array
     */
    public function setFBData($fbdata)
    {
        if (isset($fbdata['id'])) {
            $this->setFacebookId($fbdata['id']);
            $this->addRole('ROLE_FACEBOOK');
        }
        if (isset($fbdata['first_name'])) {
            $this->setFirstname($fbdata['first_name']);
        }
        if (isset($fbdata['last_name'])) {
            $this->setLastname($fbdata['last_name']);
        }
        if (isset($fbdata['email'])) {
            $this->setEmail($fbdata['email']);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryHash()
    {
        return $this->primaryHash;
    }

    /**
     * {@inheritDoc}
     */
    public function getIndexHash()
    {
        return $this->indexHash;
    }

    /**
     * {@inheritDoc}
     */
    public function getSecondaryIndexes()
    {
        return array('emailCanonical', 'usernameCanonical');
    }
}
