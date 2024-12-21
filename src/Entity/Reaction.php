<?php

namespace App\Entity;

use App\Enum\ReactionTypeEnum;
use App\Repository\ReactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReactionRepository::class)]
class Reaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    private ?User $reactor = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    private ?Publication $publication = null;

    #[ORM\ManyToOne(inversedBy: 'reactions')]
    private ?Comment $comment = null;

    #[ORM\Column(enumType: ReactionTypeEnum::class)]
    #[Groups('publication.read')]
    private ?ReactionTypeEnum $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReactor(): ?User
    {
        return $this->reactor;
    }

    public function setReactor(?User $reactor): static
    {
        $this->reactor = $reactor;

        return $this;
    }

    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    public function setPublication(?Publication $publication): static
    {
        $this->publication = $publication;

        return $this;
    }

    public function getComment(): ?Comment
    {
        return $this->comment;
    }

    public function setComment(?Comment $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getType(): ?ReactionTypeEnum
    {
        return $this->type;
    }

    public function setType(ReactionTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }
}
