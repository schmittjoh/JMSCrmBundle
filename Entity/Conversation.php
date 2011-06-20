<?php

namespace JMS\CrmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="crm_conversations")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Conversation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36, unique=true)
     */
    private $identifier;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="JMS\CrmBundle\Entity\Message", cascade = {"persist"}, orphanRemoval=true)
     */
    private $messages;

    public function __construct($identifier)
    {
        $this->identifier = $identifier;
        $this->createdAt = new \DateTime;
        $this->messages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function addMessage(Message $message)
    {
        $message->setConversation($this);
        $this->messages->add($message);
    }
}