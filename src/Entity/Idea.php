<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdeaRepository::class)
 */
class Idea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Please provide your idea!")
     * @Assert\Length(
     *      min = 2,
     *      max = 250,
     *      minMessage = "Your idea must be at least {{ limit }} characters long",
     *      maxMessage = "Your idea cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=250)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="Please provide the description!")
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "The description must be at least {{ limit }} characters long",
     *      maxMessage = "The description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Please provide your username!")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your username must be at least {{ limit }} characters long",
     *      maxMessage = "Your username cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=80)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="idea")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
