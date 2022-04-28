<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideoGameRepository;

/**
 * @ORM\Entity(repositoryClass=VideoGameRepository::class)
 */
class VideoGame implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Developer
     *
     * @ORM\ManyToOne(targetEntity="Developer")
     * @ORM\JoinColumn(name="developer_id", referencedColumnName="id", nullable=false)
     */
    private $developer;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string[]|null
     *
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $genres = null;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDeveloper(): Developer
    {
        return $this->developer;
    }

    public function setDeveloper(Developer $developer): self
    {
        $this->developer = $developer;

        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setGenres(?array $genres): self
    {
        $this->genres = $genres;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'developer' => $this->getDeveloper()->getName(),
            'genres' => $this->getGenres(),
        ];
    }
}
