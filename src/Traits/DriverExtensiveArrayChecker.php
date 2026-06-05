<?php

namespace Denkavia\Authenka\Traits;

trait DriverExtensiveArrayChecker
{
    function checkAny(array $required, array $available): bool
    {
        $available = array_flip($available);

        foreach ($required as $value) {
            if (isset($available[$value])) {
                return true;
            }
        }

        return false;
    }

    function checkAll(array $required, array $available): bool
    {
        $available = array_flip($available);

        foreach ($required as $value) {
            if (!isset($available[$value])) {
                return false;
            }
        }

        return true;
    }
}