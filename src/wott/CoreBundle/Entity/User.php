<?php

namespace wott\CoreBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="facebookId", type="string", length=255, nullable=true)
     */
    protected $facebookId;

    /**
     * @var array
     *
     * @ORM\Column(name="suggestDay", type="array", nullable=true)
     */
    protected $suggestDay;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string $facebookId
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
     * Set suggestDay
     *
     * @param  array $suggestDay
     * @return User
     */
    public function setSuggestDay($suggestDay)
    {
        $this->suggestDay = $suggestDay;

        return $this;
    }

    /**
     * Get suggestDay
     *
     * @return array
     */
    public function getSuggestDay()
    {
        return $this->suggestDay;
    }

}
