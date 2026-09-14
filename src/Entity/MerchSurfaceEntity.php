<?php

declare(strict_types=1);

namespace App\Merchandising\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'merch_surface')]
/**
 * Defines the MerchSurfaceEntity contract and behavior within Merchandising.
 */
class MerchSurfaceEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120, unique: true)]
    private string $surfaceKey = '';

    #[ORM\Column(length: 180)]
    private string $title = '';

    #[ORM\Column(length: 80)]
    private string $surfaceType = 'storefront_home';

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
    public function getSurfaceKey(): string
    {
        return $this->surfaceKey;
    }

    /**
     * Updates the stable business key that identifies this merchandising surface.
     */
    public function setSurfaceKey(string $surfaceKey): self
    {
        $this->surfaceKey = $surfaceKey;

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
    public function getSurfaceType(): string
    {
        return $this->surfaceType;
    }

    /**
     * Updates the renderer-neutral type assigned to this merchandising surface.
     */
    public function setSurfaceType(string $surfaceType): self
    {
        $this->surfaceType = $surfaceType;

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
