<?php

namespace Feeds\XmlGenerator\Enums;

/**
 * DELIVERY_ID dle specifikace Zboží.cz (Sklik) XML feedu.
 * @see https://napoveda.sklik.cz/reklamy/xml-feed/specifikace/
 */
enum ZboziDeliveryMethod: string
{
    // Výdejní místa
    case ALZABOX = 'ALZABOX';
    case CESKA_POSTA_BALIKOVNA = 'CESKA_POSTA_BALIKOVNA';
    case CESKA_POSTA_NA_POSTU = 'CESKA_POSTA_NA_POSTU';
    case DPD_PICKUP = 'DPD_PICKUP';
    case GLS_PARCELSHOP = 'GLS_PARCELSHOP';
    case PPL_PARCELSHOP = 'PPL_PARCELSHOP';
    case TOPTRANS_DEPO = 'TOPTRANS_DEPO';
    case ONE_POINT = 'ONE_POINT';
    case ZASILKOVNA = 'ZASILKOVNA';
    case VLASTNI_VYDEJNI_MISTA = 'VLASTNI_VYDEJNI_MISTA';

    // Dopravci
    case KURYR_123 = '123_KURYR';
    case CESKA_POSTA = 'CESKA_POSTA';
    case BALIKOVNA_NA_ADRESU = 'BALIKOVNA_NA_ADRESU';
    case DACHSER = 'DACHSER';
    case DB_SCHENKER = 'DB_SCHENKER';
    case DPD = 'DPD';
    case DHL = 'DHL';
    case DSV = 'DSV';
    case EMONS = 'EMONS';
    case FOFR = 'FOFR';
    case GEBRUDER_WEISS = 'GEBRUDER_WEISS';
    case GEIS = 'GEIS';
    case GLS = 'GLS';
    case HDS = 'HDS';
    case HELICAR = 'HELICAR';
    case IN_TIME_KURYR = 'IN_TIME_KURYR';
    case ONE_COURIER = 'ONE_COURIER';
    case NAS_KURYR = 'NAS_KURYR';
    case MESSENGER = 'MESSENGER';
    case LAGERMAX = 'LAGERMAX';
    case PPL = 'PPL';
    case TNT = 'TNT';
    case TOPTRANS = 'TOPTRANS';
    case UPS = 'UPS';
    case FEDEX = 'FEDEX';
    case RABEN_LOGISTICS = 'RABEN_LOGISTICS';
    case RHENUS = 'RHENUS';
    case ZASILKOVNA_NA_ADRESU = 'ZASILKOVNA_NA_ADRESU';
    case VLASTNI_PREPRAVA = 'VLASTNI_PREPRAVA';
}
