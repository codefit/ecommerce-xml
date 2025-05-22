<?php

namespace Feeds\XmlGenerator\Enums;

enum ZboziDeliveryMethod: string
{
    case PPL = 'PPL';
    case DPD = 'DPD';
    case DPD_PICKUP = 'DPD_PICKUP';
    case CPOST = 'CPOST';
    case CPOST_PICKUP = 'CPOST_PICKUP';
    case GEIS = 'GEIS';
    case GEIS_PICKUP = 'GEIS_PICKUP';
    case GLS = 'GLS';
    case GLS_PICKUP = 'GLS_PICKUP';
    case INTIME = 'INTIME';
    case INTIME_PICKUP = 'INTIME_PICKUP';
    case POST = 'POST';
    case POST_PICKUP = 'POST_PICKUP';
    case SLOVAKIA_POST = 'SLOVAKIA_POST';
    case SLOVAKIA_POST_PICKUP = 'SLOVAKIA_POST_PICKUP';
    case TOPTRANS = 'TOPTRANS';
    case TOPTRANS_PICKUP = 'TOPTRANS_PICKUP';
    case ULOZENKA = 'ULOZENKA';
    case ULOZENKA_PICKUP = 'ULOZENKA_PICKUP';
    case ZASILKOVNA = 'ZASILKOVNA';
    case ZASILKOVNA_PICKUP = 'ZASILKOVNA_PICKUP';
} 