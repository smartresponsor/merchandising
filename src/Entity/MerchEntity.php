<?php

declare(strict_types=1);

namespace App\Merchandising\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'merch_composition', uniqueConstraints: [new ORM\UniqueConstraint(name: 'uniq_merch_key', columns: ['merch_key'])])]
/**
 * Defines the MerchEntity contract and behavior within Merchandising.
 */
class MerchEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private string $merchKey = '';

    #[ORM\Column(length: 180)]
    private string $title = '';

    #[ORM\Column(length: 80)]
    private string $type = 'storefront_home';

    #[ORM\Column(length: 40)]
    private string $status = 'draft';

    /**
     * Returns the persistence identifier assigned by Doctrine for this merchandising record.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Returns the stable business key that identifies this merchandising surface.
     */
    public function getMerchKey(): string
    {
        return $this->merchKey;
    }

    /**
     * Updates the stable business key that identifies this merchandising surface.
     */
    public function setMerchKey(string $merchKey): self
    {
        $this->merchKey = $merchKey;

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
     * Returns the renderer-neutral type assigned to this merchandising surface.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Updates the renderer-neutral type assigned to this merchandising surface.
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the merchandising lifecycle status configured for this surface.
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Updates the merchandising lifecycle status configured for this surface.
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
