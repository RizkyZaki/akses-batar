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

    // Cek jika $datetime adalah string yang valid untuk DateTime
    if (!strtotime($datetime)) {
      return "Format tanggal tidak valid: " . $datetime;
  }
    
    $now = new DateTime;
    $future = new DateTime($datetime);
    $diff = $now->diff($future);

    // Check if $future (datetime) is in the past compared to $now
    $isExpired = $future < $now;

    if ($isExpired) {
      return 'Sudah Kedaluarsa';
    }

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

if (!function_exists('getTimeUntilClass')) {
  function getTimeUntilClass($datetime)
  {
    $now = new DateTime;
    $future = new DateTime($datetime);
    $diff = $now->diff($future);

    // Check if $future (datetime) is in the past compared to $now
    $isExpired = $future < $now;

    if ($isExpired) {
      return 'table-danger';
    }

    if ($diff->y >= 1) {
      return 'table-success';
    }

    if ($diff->m > 0) {
      return 'table-warning';
    }

    if ($diff->d > 0) {
      return 'table-danger';
    }

    if ($diff->h > 0) {
      return 'table-danger';
    }

    if ($diff->i > 0) {
      return 'table-danger';
    }

    return 'table-secondary';
  }
}

if (!function_exists('getRoleBadge')) {
  function getRoleBadge($role)
  {
    switch ($role) {
      case \App\Enums\UserRole::Pharmacy_Management:
        return '<span class="badge badge-success">Manajemen Farmasi</span>';
      case \App\Enums\UserRole::Pharmacy_Admin:
        return '<span class="badge badge-primary">Admin Farmasi</span>';
      default:
        return '<span class="badge badge-secondary">Role tidak diketahui</span>';
    }
  }
}