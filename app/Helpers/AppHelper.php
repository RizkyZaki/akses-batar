<?php

use Hashids\Hashids;

if (!function_exists('hashidEncode')) {
  function hashidEncode($id)
  {
    $salt    = new Hashids('SomayMangEnyoy');
    $hashids = $salt->encode([$id, 54715]);
    return $hashids;
  }
}

if (!function_exists('hashidDecode')) {
  function hashidDecode($id)
  {
    $salt    = new Hashids('SomayMangEnyoy');
    $hashids = $salt->decode($id);
    return $hashids;
  }
}
