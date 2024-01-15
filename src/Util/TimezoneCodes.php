<?php

declare(strict_types=1);

namespace CloudPaymentsSDK\Util;

/**
 * Class TimezoneCodes
 *
 * This class provides a list of supported timezones with their corresponding codes.
 *
 * @package CloudPaymentsSDK\Util
 * @link https://developers.cloudpayments.ru/en/#timezone-codes
 */
class TimezoneCodes
{
    public const HST = 'HST'; // (UTC-10:00) Hawaii
    public const AKST = 'AKST'; // (UTC-09:00) Alaska
    public const PST = 'PST'; // (UTC-08:00) Pacific Time (US and Canada)
    public const MST = 'MST'; // (UTC-07:00) Mountain time (USA and Canada)
    public const CST = 'CST'; // (UTC-06:00) Central time (USA and Canada)
    public const EST = 'EST'; // (UTC-05:00) Eastern time (USA and Canada)
    public const AST = 'AST'; // (UTC-04:00) Atlantic Time (Canada)
    public const BRT = 'BRT'; // (UTC-03:00) Brazil
    public const UTC = 'UTC'; // (UTC) UTC Format
    public const GMT = 'GMT'; // (UTC) Dublin, Lisbon, London, Edinburgh
    public const CET_AMS = 'CET'; // (UTC+01:00) Amsterdam, Berlin, Bern, Vienna, Rome, Stockholm
    public const CET_BBP = 'CET'; // (UTC+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague
    public const CET_BCM = 'CET'; // (UTC+01:00) Brussels, Copenhagen, Madrid, Paris
    public const CET_WZS = 'CET'; // (UTC+01:00) Warsaw, Zagreb, Sarajevo, Skopje
    public const EET_BUC = 'EET'; // (UTC+02:00) Athens, Bucharest
    public const EET_VKR = 'EET'; // (UTC+02:00) Vilnius, Kiev, Riga, Sofia, Tallinn, Helsinki
    public const EET_EE = 'EET'; // (UTC+02:00) Eastern Europe
    public const EET_KGD = 'EET'; // (UTC+02:00) Kaliningrad (RTZ 1)
    public const MSK_VGS = 'MSK'; // (UTC+03:00) Volgograd, Moscow, St. Petersburg (RTZ 2)
    public const MSK_MNSK = 'MSK'; // (UTC+03:00) Minsk
    public const AZT_BAK = 'AZT'; // (UTC+04:00) Baku
    public const AMT_ERV = 'AMT'; // (UTC+04:00) Yerevan
    public const SAMT_ISM = 'SAMT'; // (UTC+04:00) Izhevsk, Samara (RTZ 3)
    public const GET_TBS = 'GET'; // (UTC+04:00) Tbilisi
    public const TJT_AST = 'TJT'; // (UTC+05:00) Ashgabat, Tashkent
    public const YEKT_EKB = 'YEKT'; // (UTC+05:00) Yekaterinburg (RTZ 4)
    public const ALMT_NUR = 'ALMT'; // (UTC+06:00) Astana, Almaty
    public const NOVT_OVB = 'NOVT'; // (UTC+06:00) Novosibirsk (RTZ 5)
    public const KRAT_KJA = 'KRAT'; // (UTC+07:00) Krasnoyarsk (RTZ 6)
    public const HKT_HKG = 'HKT'; // (UTC+08:00) Hong Kong, Beijing, Urumqi, Chongqing
    public const IRKT_IRK = 'IRKT'; // (UTC+08:00) Irkutsk (RTZ 7)
    public const SGT_KUL = 'SGT'; // (UTC+08:00) Kuala Lumpur, Singapore
    public const ULAT_ULA = 'ULAT'; // (UTC+08:00) Ulaanbaatar
    public const YAKT_YAK = 'YAKT'; // (UTC+09:00) Yakutsk (RTZ 8)
    public const VLAT_VLAD = 'VLAT'; // (UTC+10:00) Vladivostok, Magadan (RTZ 9)
    public const SAKT_CHU = 'SAKT'; // (UTC+11:00) Chokurdah (RTZ 10)
    public const ANAT_PET = 'ANAT'; // (UTC+12:00) Anadyr, Petropavlovsk-Kamchatsky (RTZ 11)
}

