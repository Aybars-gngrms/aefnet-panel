<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;

class HashController extends Controller
{
    public function AefnetHash($Veri)
    {
        $plaintext = $Veri;
        $password = Config::get('AefnetConfig.WebHashPassword'); //'RedAlert2AefnetTR-2023';
        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $pad = null;
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $encrypted = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $Veri1 = $encrypted;
        $Data = str_replace(['+', '/'], ['-', '_'], base64_encode($Veri1));
        if (!$pad) {
            $Data = rtrim($Data, '=');
        }
        return $Data;
    }

    public function AefnetHashCoz($Veri)
    {
        $ByteText = $Veri;
        $password = Config::get('AefnetConfig.WebHashPassword'); //'RedAlert2AefnetTR-2023';
        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', $password, true), 0, 32);
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $Veri2 = base64_decode(str_replace(array('-', '_'), array('+', '/'), $ByteText));
        $Sonuc = openssl_decrypt($Veri2, $method, $key, OPENSSL_RAW_DATA, $iv);
        return $Sonuc;
    }
}
