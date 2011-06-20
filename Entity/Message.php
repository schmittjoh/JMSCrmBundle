<?php

namespace JMS\CrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="crm_messages")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 *
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="auto")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="JMS\CrmBundle\Entity\Conversation")
     */
    private $conversation;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\Email
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $message;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getConversation()
    {
        return $this->conversation;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setConversation(Conversation $conversation)
    {
        if (null !== $this->conversation) {
            throw new \RuntimeException('This message is already linked to a conversation.');
        }

        $this->conversation = $conversation;
    }

    public function setName($name)
    {
        $this->assertNew();
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->assertNew();
        $this->email = $email;
    }

    public function setText($text)
    {
        $this->assertNew();
        $this->text = $text;
    }

    private function assertNew()
    {
        if (null !== $this->id) {
            throw new \RuntimeException('This record is immutable after it has been saved.');
        }
    }
}