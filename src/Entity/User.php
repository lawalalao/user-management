<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $firstName;

//    /**
//     * @var string
//     *
//     * @ORM\Column(type="string", nullable=true, length=64)
//     */
//    private $lastName;

//    /**
//     * @var string
//     *
//     * @ORM\Column(type="string", nullable=true, length=64)
//     */
//    private $organization;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

//    /**
//     * @ORM\Column(type="string", length=255, unique=true)
//     * @Assert\NotBlank()
//     */
//    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="is_valid", nullable=true, type="boolean")
     */
    private $isValid;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

//    /**
//     * @var string
//     *
//     * @ORM\Column(type="string", length=15, nullable=true, unique=true)
//     */
//    private $phone1;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15, nullable=true, unique=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true, length=64)
     */
    private $userType;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */

    private $lastConnectionAt;


    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->isActive = false;
        $this->isValid = false;
    }

    // other properties and methods

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getfirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setfirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

//    /**
//     * @return string
//     */
//    public function getlastName()
//    {
//        return $this->lastName;
//    }
//
//    /**
//     * @param string $lastName
//     *
//     * @return $this
//     */
//    public function setlastName($lastName)
//    {
//        $this->lastName = $lastName;
//
//        return $this;
//    }
    // new function here start

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     *
     * @return $this
     */
    public function setUserType(string $userType): User
    {
        $this->userType = $userType;

        return $this;
    }




    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }



    /**
     * Set isValid
     *
     * @param boolean $isValid
     * @return User
     */
    public function setIsValid(bool $isValid): User
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean
     */
    public function getIsValid()
    {
        return $this->isValid;
    }



    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }


//    /**
//     * @return string
//     */
//    public function getPhone2()
//    {
//        return $this->phone2;
//    }
//
//    /**
//     * @param string $phone2
//     *
//     * @return $this
//     */
//    public function setPhone2($phone2)
//    {
//        $this->phone2 = $phone2;
//
//        return $this;
//    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     *
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     *
     * @return User
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }

    /**
     * @ORM\PreUpdate
     *
     * @return User
     */
    public function setLastConnectionAt ()
    {
        $this->lastConnectionAt  = new \DateTime('now');

        return $this;
    }

    /**
     * Gets the last login time.
     *
     * @return \DateTime|null
     */
    public function getLastConnectionAt(): ?\DateTime
    {
        return $this->lastConnectionAt;
    }


//    /**
//     * @return string
//     */
//    public function getWebsite()
//    {
//        return $this->website;
//    }
//
//    /**
//     * @param string $website
//     *
//     * @return $this
//     */
//    public function setWebsite($website)
//    {
//        $this->website = $website;
//
//        return $this;
//    }



}
