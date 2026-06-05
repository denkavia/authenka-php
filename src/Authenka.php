<?php

namespace Denkavia\Authenka;

use Closure;
use Denkavia\Authenka\Contracts\AuthenkaDriver;
use Denkavia\Authenka\Exceptions\InvalidArgumentException;

class Authenka
{
    public function __construct(
        protected array $config,
        protected array $drivers = []
    )
    {
    }

    public function registerDriver(string $driver, Closure $callback): static
    {
        $this->drivers[$driver] = $callback;

        return $this;
    }

    public function removeDriver(string $driver): static
    {
        unset($this->drivers[$driver]);

        return $this;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function __call(string $method, array $arguments)
    {
        return $this->driver()->$method(...$arguments);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function driver(?string $driverName = null): AuthenkaDriver
    {
        if (is_null($driverName)) {
            $driverName = $this->getDefaultDriver();
        }

        $driverInstance = $this->drivers[$driverName];

        if (!$driverInstance instanceof AuthenkaDriver) {
            throw new InvalidArgumentException("Invalid driver: {$driverName}");
        }

        return $driverInstance;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function getDefaultDriver(): string
    {
        if (!$this->config['default']) {
            throw new InvalidArgumentException("There's default driver configured");
        }

        return $this->config['default'];
    }
}