<?php

namespace SvNDev\Support;

use ReflectionClass;

class Helpers
{
  public static function getConfigPath(?string $append = null): string
  {
    $reflection = new ReflectionClass(self::class);
    $realPath   = realpath(dirname($reflection->getFileName()) . '/../../config');

    if (!$append) {
      return $realPath;
    }

    return "{$realPath}/{$append}";
  }
}