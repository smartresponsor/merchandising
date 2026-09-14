<?php

declare(strict_types=1);

namespace App\Merchandising\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'merch_placement')]
/**
 * Defines the MerchPlacementEntity contract and behavior within Merchandising.
 */
class MerchPlacementEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private string $placementKey = '';

    #[ORM\Column(length: 80)]
    private string $sourceType = '';

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $sourceReference = null;

    #[ORM\Column]
    private int $priority = 0;

    /**
     * Returns the persistence identifier assigned by Doctrine for this merchandising record.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the stable business key that identifies this merchandising placement.
     */
    public function getPlacementKey(): string
    {
        return $this->placementKey;
    }

    /**
     * Updates the stable business key that identifies this merchandising placement.
     */
    public function setPlacementKey(string $placementKey): self
    {
        $this->placementKey = $placementKey;

        return $this;
    }

    /**
     * Returns the owner-provided source type represented by this merchandising placement.
     */
    public function getSourceType(): string
    {
        return $this->sourceType;
    }

    /**
     * Updates the owner-provided source type represented by this merchandising placement.
     */
    public function setSourceType(string $sourceType): self
    {
        $this->sourceType = $sourceType;

        return $this;
    }

    /**
     * Returns the optional owner-side reference associated with this merchandising placement.
     */
    public function getSourceReference(): ?string
    {
        return $this->sourceReference;
    }

    /**
     * Updates the optional owner-side reference associated with this merchandising placement.
     */
    public function setSourceReference(?string $sourceReference): self
    {
        $this->sourceReference = $sourceReference;

        return $this;
    }

    /**
     * Returns the merchandising ordering priority used when composing the owning structure.
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Updates the merchandising ordering priority used when composing the owning structure.
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
