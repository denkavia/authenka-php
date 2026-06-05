<?php

namespace Denkavia\Authenka\Traits;

trait DriverSimpleArrayChecker
{
    function checkAny(array $required, array $available): bool
    {
        return !empty(array_intersect($required, $available));
    }

    function checkAll(array $required, array $available): bool
    {
        return empty(array_diff($required, $available));
    }
}