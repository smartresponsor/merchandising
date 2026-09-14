<?php

declare(strict_types=1);

namespace App\Merchandising\Enum;

/**
 * Canonical neighboring component keys allowed to provide direct merchandising candidates.
 *
 * These values are intentionally business/component names, not table names and not route names. They make the
 * data-owner relationship machine-readable for agents and host-application wiring.
 */
enum MerchSourceComponent: string
{
    case Cataloging = 'cataloging';
    case Producting = 'producting';
    case Projecting = 'projecting';
    case Vendoring = 'vendoring';
    case Usering = 'usering';
    case Accessing = 'accessing';
    case Advertising = 'advertising';
    case Campaigning = 'campaigning';
    case Managing = 'managing';
}
