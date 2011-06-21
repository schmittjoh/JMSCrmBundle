<?php

namespace JMS\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crm_users")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="smallint")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="array")
     */
    private $groups;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->groups = array();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function hasAnyGroup(array $groups)
    {
        foreach ($groups as $group) {
            if (isset($this->groups[strtolower($group)])) {
                return true;
            }
        }

        return false;
    }

    public function hasGroup($group)
    {
        return isset($this->groups[strtolower($group)]);
    }

    public function addGroup($group)
    {
        $this->groups[strtolower($group)] = true;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function setGroups(array $groups)
    {
        $this->groups = $groups;
    }
}