<?php
namespace App;
class Currency
{
    protected static $cached = [];

    public static function getAll()
    {
        $res = [];
        foreach (self::$currency_name as $code => $name) {
            //$code = strtolower($code);
            $res[strtolower($code)] = [
                'id'       => strtolower($code),
                'name'     => $name . (isset(self::$currency_symbols[$code]) ? ' (' . html_entity_decode(self::$currency_symbols[$code]) . ')' : ''),
                'raw_name' => $name,
                'symbol'   => isset(self::$currency_symbols[$code]) ? html_entity_decode(self::$currency_symbols[$code]) : ''
            ];
        }
        return $res;
    }

    public static function getCurrency($code)
    {
        if (isset(static::$cached[$code]))
            return static::$cached[$code];
        $all = self::getAll();
        if (isset($all[$code])) {
            static::$cached[$code] = $all[$code];
            return static::$cached[$code];
        }
        return [];
    }

    public static function format($price)
    {


        $currency_main = setting_item('currency_main');
        $currency_format = setting_item('currency_format');
        $currency_decimal = setting_item('currency_decimal');
        $currency_thousand = setting_item('currency_thousand');
        $currency_no_decimal = setting_item('currency_no_decimal');
        $s = number_format((float)$price, (int)$currency_no_decimal, $currency_decimal, $currency_thousand);
        $currency = self::getCurrency($currency_main);
        if (!empty($currency)) {

            switch ($currency_format) {
                case "right_space";
                    return $s . ' ' . $currency['symbol'];
                    break;
                case "left";
                    return $currency['symbol'] . $s;
                    break;
                case "left_space";
                    return $currency['symbol'] . ' ' . $s;
                    break;
                default:
                    return $s . $currency['symbol'];
                    break;
            }
        }
        return $s;
    }

    public static $currency_name    = array(
        'ALL' => 'Albania Lek',
        'AFN' => 'Afghanistan Afghani',
        'ARS' => 'Argentina Peso',
        'AWG' => 'Aruba Guilder',
        'AUD' => 'Australia Dollar',
        'AZN' => 'Azerbaijan New Manat',
        'BSD' => 'Bahamas Dollar',
        'BBD' => 'Barbados Dollar',
        'BDT' => 'Bangladeshi taka',
        'BYR' => 'Belarus Ruble',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermuda Dollar',
        'BOB' => 'Bolivia Boliviano',
        'BAM' => 'Bosnia and Herzegovina Convertible Marka',
        'BWP' => 'Botswana Pula',
        'BGN' => 'Bulgaria Lev',
        'BRL' => 'Brazil Real',
        'BND' => 'Brunei Darussalam Dollar',
        'KHR' => 'Cambodia Riel',
        'CAD' => 'Canada Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chile Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombia Peso',
        'CRC' => 'Costa Rica Colon',
        'HRK' => 'Croatia Kuna',
        'CUP' => 'Cuba Peso',
        'CZK' => 'Czech Republic Koruna',
        'DKK' => 'Denmark Krone',
        'DOP' => 'Dominican Republic Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egypt Pound',
        'SVC' => 'El Salvador Colon',
        'EEK' => 'Estonia Kroon',
        'EUR' => 'Euro Member Countries',
        'FKP' => 'Falkland Islands (Malvinas) Pound',
        'FJD' => 'Fiji Dollar',
        'GHC' => 'Ghana Cedis',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala Quetzal',
        'GGP' => 'Guernsey Pound',
        'GYD' => 'Guyana Dollar',
        'HNL' => 'Honduras Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'India Rupee',
        'IDR' => 'Indonesia Rupiah',
        'IRR' => 'Iran Rial',
        'IMP' => 'Isle of Man Pound',
        'ILS' => 'Israel Shekel',
        'JMD' => 'Jamaica Dollar',
        'JPY' => 'Japan Yen',
        'JEP' => 'Jersey Pound',
        'KZT' => 'Kazakhstan Tenge',
        'KPW' => 'Korea (North) Won',
        'KRW' => 'Korea (South) Won',
        'KGS' => 'Kyrgyzstan Som',
        'LAK' => 'Laos Kip',
        'LVL' => 'Latvia Lat',
        'LBP' => 'Lebanon Pound',
        'LRD' => 'Liberia Dollar',
        'LTL' => 'Lithuania Litas',
        'MKD' => 'Macedonia Denar',
        'MYR' => 'Malaysia Ringgit',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexico Peso',
        'MNT' => 'Mongolia Tughrik',
        'MZN' => 'Mozambique Metical',
        'NAD' => 'Namibia Dollar',
        'NPR' => 'Nepal Rupee',
        'ANG' => 'Netherlands Antilles Guilder',
        'NZD' => 'New Zealand Dollar',
        'NIO' => 'Nicaragua Cordoba',
        'NGN' => 'Nigeria Naira',
        'NOK' => 'Norway Krone',
        'OMR' => 'Oman Rial',
        'PKR' => 'Pakistan Rupee',
        'PAB' => 'Panama Balboa',
        'PYG' => 'Paraguay Guarani',
        'PEN' => 'Peru Nuevo Sol',
        'PHP' => 'Philippines Peso',
        'PLN' => 'Poland Zloty',
        'QAR' => 'Qatar Riyal',
        'RON' => 'Romania New Leu',
        'RUB' => 'Russia Ruble',
        'SHP' => 'Saint Helena Pound',
        'SAR' => 'Saudi Arabia Riyal',
        'RSD' => 'Serbia Dinar',
        'SCR' => 'Seychelles Rupee',
        'SGD' => 'Singapore Dollar',
        'SBD' => 'Solomon Islands Dollar',
        'SOS' => 'Somalia Shilling',
        'ZAR' => 'South Africa Rand',
        'LKR' => 'Sri Lanka Rupee',
        'SEK' => 'Sweden Krona',
        'CHF' => 'Switzerland Franc',
        'SRD' => 'Suriname Dollar',
        'SYP' => 'Syria Pound',
        'TWD' => 'Taiwan New Dollar',
        'THB' => 'Thailand Baht',
        'TTD' => 'Trinidad and Tobago Dollar',
        'TRY' => 'Turkey Lira',
        'TRL' => 'Turkey Lira',
        'TVD' => 'Tuvalu Dollar',
        'UAH' => 'Ukraine Hryvna',
        'GBP' => 'United Kingdom Pound',
        'USD' => 'United States Dollar',
        'UYU' => 'Uruguay Peso',
        'UZS' => 'Uzbekistan Som',
        'VEF' => 'Venezuela Bolivar',
        'VND' => 'Viet Nam Dong',
        'YER' => 'Yemen Rial',
        'ZWD' => 'Zimbabwe Dollar',
        "KES" => "Kenyan shilling",
        "AED" => "Emirati Dirham"
    );
    public static $currency_symbols = array(
        'AED' => '&#1583;.&#1573;',
        // ?
        'AFN' => '&#65;&#102;',
        'ALL' => '&#76;&#101;&#107;',
        'AMD' => '&#1380;',
        'ANG' => '&#402;',
        'AOA' => '&#75;&#122;',
        // ?
        'ARS' => '&#36;',
        'AUD' => '&#36;',
        'AWG' => '&#402;',
        'AZN' => '&#8380;',
        'BAM' => '&#75;&#77;',
        'BBD' => '&#36;',
        'BDT' => '&#2547;',
        // ?
        'BGN' => '&#1083;&#1074;',
        'BHD' => '.&#1583;.&#1576;',
        // ?
        'BIF' => '&#70;&#66;&#117;',
        // ?
        'BMD' => '&#36;',
        'BND' => '&#36;',
        'BOB' => '&#36;&#98;',
        'BRL' => '&#82;&#36;',
        'BSD' => '&#36;',
        'BTN' => '&#78;&#117;&#46;',
        // ?
        'BWP' => '&#80;',
        'BYR' => '&#112;&#46;',
        'BZD' => '&#66;&#90;&#36;',
        'CAD' => '&#36;',
        'CDF' => '&#70;&#67;',
        'CHF' => '&#67;&#72;&#70;',
        'CLF' => '&#85;&#70;',
        // ?
        'CLP' => '&#36;',
        'CNY' => '&#165;',
        'COP' => '&#36;',
        'CRC' => '&#8353;',
        'CUP' => '&#8396;',
        'CVE' => '&#36;',
        // ?
        'CZK' => '&#75;&#269;',
        'DJF' => '&#70;&#100;&#106;',
        // ?
        'DKK' => '&#107;&#114;',
        'DOP' => '&#82;&#68;&#36;',
        'DZD' => '&#1583;&#1580;',
        // ?
        'EGP' => 'E&#163;',
        'ETB' => '&#66;&#114;',
        'EUR' => '&#8364;',
        'FJD' => '&#36;',
        'FKP' => '&#163;',
        'GBP' => '&#163;',
        'GEL' => '&#4314;',
        // ?
        'GHS' => '&#162;',
        'GIP' => '&#163;',
        'GMD' => '&#68;',
        // ?
        'GNF' => '&#70;&#71;',
        // ?
        'GTQ' => '&#81;',
        'GYD' => '&#36;',
        'HKD' => '&#36;',
        'HNL' => '&#76;',
        'HRK' => '&#107;&#110;',
        'HTG' => '&#71;',
        // ?
        'HUF' => '&#70;&#116;',
        'IDR' => '&#82;&#112;',
        'ILS' => '&#8362;',
        'INR' => '&#8377;',
        'IQD' => '&#1593;.&#1583;',
        // ?
        'IRR' => '&#65020;',
        'ISK' => '&#107;&#114;',
        'JEP' => '&#163;',
        'JMD' => '&#74;&#36;',
        'JOD' => '&#74;&#68;',
        // ?
        'JPY' => '&#165;',
        'KES' => '&#75;&#83;&#104;',
        // ?
        'KGS' => '&#1083;&#1074;',
        'KHR' => '&#6107;',
        'KMF' => '&#67;&#70;',
        // ?
        'KPW' => '&#8361;',
        'KRW' => '&#8361;',
        'KWD' => '&#1583;.&#1603;',
        // ?
        'KYD' => '&#36;',
        'KZT' => '&#8376;',
        'LAK' => '&#8365;',
        'LBP' => '&#163;',
        'LKR' => '&#8360;',
        'LRD' => '&#36;',
        'LSL' => '&#76;',
        // ?
        'LTL' => '&#76;&#116;',
        'LVL' => '&#76;&#115;',
        'LYD' => '&#1604;.&#1583;',
        // ?
        'MAD' => '&#1583;.&#1605;.',
        //?
        'MDL' => '&#76;',
        'MGA' => '&#65;&#114;',
        // ?
        'MKD' => '&#1076;&#1077;&#1085;',
        'MMK' => '&#75;',
        'MNT' => '&#8366;',
        'MOP' => '&#77;&#79;&#80;&#36;',
        // ?
        'MRO' => '&#85;&#77;',
        // ?
        'MUR' => '&#8360;',
        // ?
        'MVR' => '.&#1923;',
        // ?
        'MWK' => '&#77;&#75;',
        'MXN' => '&#36;',
        'MYR' => '&#82;&#77;',
        'MZN' => '&#77;&#84;',
        'NAD' => '&#36;',
        'NGN' => '&#8358;',
        'NIO' => '&#67;&#36;',
        'NOK' => '&#107;&#114;',
        'NPR' => '&#8360;',
        'NZD' => '&#36;',
        'OMR' => '&#65020;',
        'PAB' => '&#66;&#47;&#46;',
        'PEN' => '&#83;&#47;&#46;',
        'PGK' => '&#75;',
        // ?
        'PHP' => '&#8369;',
        'PKR' => '&#8360;',
        'PLN' => '&#122;&#322;',
        'PYG' => '&#71;&#115;',
        'QAR' => '&#65020;',
        'RON' => '&#108;&#101;&#105;',
        'RSD' => '&#1044;&#1080;&#1085;&#46;',
        'RUB' => '&#8381;',
        'RWF' => '&#1585;.&#1587;',
        'SAR' => '&#65020;',
        'SBD' => '&#36;',
        'SCR' => '&#8360;',
        'SDG' => '&#163;',
        // ?
        'SEK' => '&#107;&#114;',
        'SGD' => '&#36;',
        'SHP' => '&#163;',
        'SLL' => '&#76;&#101;',
        // ?
        'SOS' => '&#83;',
        'SRD' => '&#36;',
        'STD' => '&#68;&#98;',
        // ?
        'SVC' => '&#36;',
        'SYP' => '&#163;',
        'SZL' => '&#76;',
        // ?
        'THB' => '&#3647;',
        'TJS' => '&#84;&#74;&#83;',
        // ? TJS (guess)
        'TMT' => '&#109;',
        'TND' => '&#1583;.&#1578;',
        'TOP' => '&#84;&#36;',
        'TRY' => '&#8356;',
        // New Turkey Lira (old symbol used)
        'TTD' => '&#36;',
        'TWD' => '&#78;&#84;&#36;',
        'TZS' => '&#84;&#83;&#104;',
        'UAH' => '&#8372;',
        'UGX' => '&#85;&#83;&#104;',
        'USD' => '&#36;',
        'UYU' => '&#36;&#85;',
        'UZS' => '&#1083;&#1074;',
        'VEF' => '&#66;&#115;',
        'VND' => '&#8363;',
        'VUV' => '&#86;&#84;',
        'WST' => '&#87;&#83;&#36;',
        'XAF' => '&#70;&#67;&#70;&#65;',
        'XCD' => '&#36;',
        'XDR' => '&#83;&#68;&#82;',
        'XOF' => '&#70;&#67;&#70;&#65;',
        'XPF' => '&#70;',
        'YER' => '&#65020;',
        'ZAR' => '&#82;',
        'ZMK' => '&#90;&#75;',
        // ?
        'ZWL' => '&#90;&#36;',
    );
}