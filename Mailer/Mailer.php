<?php

namespace JMS\CrmBundle\Mailer;

use JMS\CrmBundle\Entity\Conversation;
use JMS\CrmBundle\Entity\Message;
use Doctrine\ORM\EntityManager;

class Mailer
{
    private $mailer;
    private $em;
    private $fromEmail;
    private $users = array();

    public function __construct(\Swift_Mailer $mailer, EntityManager $em, $fromEmail)
    {
        $this->mailer = $mailer;
        $this->em = $em;
        $this->fromEmail = $fromEmail;
    }

    public function sendMessage(Message $message, array $groups)
    {
        $conversation = $message->getConversation();

        foreach ($this->getUsers() as $user) {
            if (!$user->hasAnyGroup($groups)) {
                continue;
            }

            $message = \Swift_Message::getInstance()
                ->setSubject($message->getSubject())
                ->setBody($message->getMessage())
                ->setFrom(sprintf('%s+%s', $this->fromEmail, $conversation->getIdentifier()), $message->getName())
                ->setTo($user->getEmail(), $user->getName())
            ;
            $this->mailer->send($message);
        }
    }

    private function getUsers()
    {
        if ($this->users) {
            return $this->users;
        }

        return $this->users = $this->em->createQuery("SELECT u FROM JMS\CrmBundle\Entity\User u")
                                ->getResult();
    }
}