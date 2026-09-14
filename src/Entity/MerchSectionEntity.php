<?php

declare(strict_types=1);

namespace App\Merchandising\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'merch_section')]
/**
 * Defines the MerchSectionEntity contract and behavior within Merchandising.
 */
class MerchSectionEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private string $sectionKey = '';

    #[ORM\Column(length: 180)]
    private string $title = '';

    #[ORM\Column(length: 80)]
    private string $sectionType = 'card_grid';

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
     * Returns the stable business key that identifies this merchandising section.
     */
    public function getSectionKey(): string
    {
        return $this->sectionKey;
    }

    /**
     * Updates the stable business key that identifies this merchandising section.
     */
    public function setSectionKey(string $sectionKey): self
    {
        $this->sectionKey = $sectionKey;

        return $this;
    }

    /**
     * Returns the merchant-facing title configured for this merchandising structure.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Updates the merchant-facing title configured for this merchandising structure.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the renderer-neutral section type used by downstream presentation adapters.
     */
    public function getSectionType(): string
    {
        return $this->sectionType;
    }

    /**
     * Updates the renderer-neutral section type used by downstream presentation adapters.
     */
    public function setSectionType(string $sectionType): self
    {
        $this->sectionType = $sectionType;

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
