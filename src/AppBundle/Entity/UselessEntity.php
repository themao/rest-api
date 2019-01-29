<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UselessEntityRepository")
 * @ORM\Table(name="useless_entity")
 * @JMS\ExclusionPolicy("all")
 */
class UselessEntity
{
    use TimestampableEntity;

    /**
     * @var int $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"default"})
     * @JMS\Expose
     */
    private $id;

    /**
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @JMS\Groups({"default"})
     * @JMS\Expose
     */
    private $meh;

    /**
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @JMS\Groups({"default"})
     * @JMS\Expose
     */
    private $whatever;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UselessEntity
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMeh(): ?string
    {
        return $this->meh;
    }

    /**
     * @param string $meh
     * @return UselessEntity
     */
    public function setMeh(string $meh)
    {
        $this->meh = $meh;
        return $this;
    }

    /**
     * @return string
     */
    public function getWhatever(): ?string
    {
        return $this->whatever;
    }

    /**
     * @param string $whatever
     * @return UselessEntity
     */
    public function setWhatever(string $whatever)
    {
        $this->whatever = $whatever;
        return $this;
    }
}
