<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="text", length=100)
     */

    public $name;
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName( string $name): void
    {
        $this->name = $name;
    }
    /**
     * @ORM\Column(type="text", length=100)
     */

    public $email;
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @ORM\Column(type="text", length=100)
     */
    public $password;
    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password):void
    {
        $this->password = $password;
    }
    /**
     * @ORM\Column(type="text", length=100)
     */
    public $class;
    public function getClass(): ?string
    {
        return $this->class;
    }
    public function setClass(string $class): void
    {
        $this->class = $class;
    }
    /**
     * @ORM\Column(type="text", length=100)
     */
    public $marks;
    public function getMarks(): ?int
    {
        return $this->marks;
    }
    public function setMarks( int $marks): void
    {
        $this->marks = $marks;
    }
    /**
     * @ORM\Column(type="text", length=100)
     */
    public $gendor;
    public function getGendor(): ?string
    {
        return $this->gendor;
    }

    public function setGendor(string $gendor): void
    {
        $this->gendor = $gendor;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }





}
