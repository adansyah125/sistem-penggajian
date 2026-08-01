<?php

namespace App\Support;

class Terbilang
{
    public static function convert($number)
    {
        $number = (float) $number;
        $base = floor($number);
        $sen = (int) round(($number - $base) * 100);

        $words = self::angkaToWords($base);
        $result = ucfirst($words);

        if ($sen > 0) {
            $result .= ' koma ' . self::angkaToWords($sen) . ' sen';
        }

        return $result . ' rupiah';
    }

    private static function angkaToWords($n)
    {
        $n = (int) $n;

        if ($n < 0) {
            return 'minus ' . self::angkaToWords(abs($n));
        }

        if ($n == 0) {
            return 'nol';
        }

        $units = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $teens = ['sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'];

        if ($n < 10) {
            return $units[$n];
        }

        if ($n < 20) {
            return $teens[$n - 10];
        }

        if ($n < 100) {
            $t = (int) floor($n / 10);
            $s = $n % 10;
            $result = $units[$t] . ' puluh';
            if ($s > 0) {
                $result .= ' ' . $units[$s];
            }
            return $result;
        }

        if ($n < 1000) {
            $h = (int) floor($n / 100);
            $s = $n % 100;
            $result = $h == 1 ? 'seratus' : $units[$h] . ' ratus';
            if ($s > 0) {
                $result .= ' ' . self::angkaToWords($s);
            }
            return $result;
        }

        $scales = [
            1000000000000 => 'triliun',
            1000000000 => 'miliar',
            1000000 => 'juta',
            1000 => 'ribu',
        ];

        foreach ($scales as $value => $label) {
            if ($n >= $value) {
                $q = (int) floor($n / $value);
                $r = $n % $value;
                $result = $q == 1 && $value == 1000 ? 'seribu' : self::angkaToWords($q) . ' ' . $label;
                if ($r > 0) {
                    $result .= ' ' . self::angkaToWords($r);
                }
                return $result;
            }
        }

        return (string) $n;
    }
}
