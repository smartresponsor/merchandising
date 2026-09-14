<?php

declare(strict_types=1);

namespace App\Merchandising\ValueObject;

/**
 * Defines the MerchActionView contract and behavior within Merchandising.
 */
final readonly class MerchActionView
{
    /**
     * Initializes the MerchActionView.
     */
    public function __construct(
        public string $label,
        public string $href,
        public string $kind = 'link',
    ) {
    }

    /**
     * Serializes the action into the stable renderer-neutral action contract used by downstream presentation layers.
     *
     * @return array{label:string,href:string,kind:string}
     */
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'href' => $this->href,
            'kind' => $this->kind,
        ];
    }
}
