<?php

namespace Feeds\XmlGenerator\Enums;

/**
 * DELIVERY_ID dle specifikace Heureka XML feedu.
 * @see https://sluzby.heureka.cz/napoveda/xml-feed/#DELIVERY
 */
enum HeurekaDeliveryMethod: string
{
    // Doručení na adresu
    case CESKA_POSTA = 'CESKA_POSTA';
    case CESKA_POSTA_DOPORUCENA_ZASILKA = 'CESKA_POSTA_DOPORUCENA_ZASILKA';
    case CSAD_LOGISTIK_OSTRAVA = 'CSAD_LOGISTIK_OSTRAVA';
    case DPD = 'DPD';
    case DHL = 'DHL';
    case DSV = 'DSV';
    case FOFR = 'FOFR';
    case GEBRUDER_WEISS = 'GEBRUDER_WEISS';
    case GEIS = 'GEIS';
    case GLS = 'GLS';
    case PPL = 'PPL';
    case SEEGMULLER = 'SEEGMULLER';
    case TOPTRANS = 'TOPTRANS';
    case UPS = 'UPS';
    case FEDEX = 'FEDEX';
    case RABEN_LOGISTICS = 'RABEN_LOGISTICS';
    case ZASILKOVNA_NA_ADRESU = 'ZASILKOVNA_NA_ADRESU';
    case ONE_COURIER = 'ONE_COURIER';
    case RHENUS_LOGISTICS = 'RHENUS_LOGISTICS';
    case MESSENGER = 'MESSENGER';
    case BALIKOVNA_NA_ADRESU = 'BALIKOVNA_NA_ADRESU';
    case QDL = 'QDL';
    case DB_SCHENKER = 'DB_SCHENKER';
    case EMONS = 'EMONS';

    // Výdejní místa
    case ZASILKOVNA = 'ZASILKOVNA';
    case DPD_PICKUP = 'DPD_PICKUP';
    case BALIKOVNA_DEPOTAPI = 'BALIKOVNA_DEPOTAPI';
    case ONE_POINT = 'ONE_POINT';
    case PPL_PARCELSHOP = 'PPL_PARCELSHOP';
    case GLS_PARCELSHOP = 'GLS_PARCELSHOP';
    case ALZAPOINT = 'ALZAPOINT';
    case UPS_ACCESS_POINT = 'UPS_ACCESS_POINT';

    // Výdejní boxy
    case DPD_BOX = 'DPD_BOX';
    case Z_BOX = 'Z_BOX';
    case ONE_BOX = 'ONE_BOX';
    case PPL_PARCELBOX = 'PPL_PARCELBOX';
    case BALIKOVNA_BOX = 'BALIKOVNA_BOX';
    case ALZABOX = 'ALZABOX';
    case GLS_PARCELBOX = 'GLS_PARCELBOX';

    // Ostatní
    case ONLINE = 'ONLINE';
    case VLASTNI_PREPRAVA = 'VLASTNI_PREPRAVA';
}
