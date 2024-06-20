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

if (!function_exists('timeUntil')) {
  function timeUntil($datetime)
  {
    $now = new DateTime;
    $future = new DateTime($datetime);
    $diff = $now->diff($future);

    if ($diff->y >= 1) {
      return 'Kurang dari ' . ($diff->y + 1) . ' tahun';
    }

    if ($diff->m > 0) {
      return 'Kurang dari ' . ($diff->m + 1) . ' bulan';
    }

    if ($diff->d > 0) {
      return $diff->d . ' hari lagi';
    }

    if ($diff->h > 0) {
      return $diff->h . ' jam lagi';
    }

    if ($diff->i > 0) {
      return $diff->i . ' menit lagi';
    }

    return 'baru saja';
  }
}
