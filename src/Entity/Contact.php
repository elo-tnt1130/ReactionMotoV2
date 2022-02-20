<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * firstname
     *
     * @var string|null
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * lastname
     *
     * @var string|null
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * tel
     *
     * @var string|null
     * @Assert\NotBlank()
     */
    private $tel;

    /**
     * mail
     *
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $mail;

    /**
     * Subject
     *
     * @var string|null
     * @Assert\NotBlank()
     */
    private $subject;

    /**
     * Message
     *
     * @var string|null
     * @Assert\NotBlank()
     */
    private $message;


    

    /**
     * Get pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @return  string|null
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @param  string|null  $firstname  pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @return  string|null
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @param  string|null  $lastname  pattern:"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$")
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$")
     *
     * @return  string|null
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$")
     *
     * @param  string|null  $tel  pattern="^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$")
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get mail
     *
     * @return  string|null
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set mail
     *
     * @param  string|null  $mail  mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get subject
     *
     * @return  string|null
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject
     *
     * @param  string|null  $subject  Subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get message
     *
     * @return  string|null
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param  string|null  $message  Message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }
}
