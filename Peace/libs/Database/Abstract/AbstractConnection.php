<?php
namespace Peace\Libs\Database\Abstract;

use Peace\Libs\Config;
use Peace\Libs\Database\Interface\ConnectionInterface;

/**
 * Class AbstractConnection
 *
 * Provides a base implementation for database connections.
 */
abstract class AbstractConnection implements ConnectionInterface {
    /**
     * @var Config The configuration settings for the connection.
     */
    protected Config $config;

    /**
     * @var bool Indicates whether the connection is established.
     */
    protected bool $connected = false;

    /**
     * AbstractConnection constructor.
     *
     * @param Config $config The configuration settings for the connection.
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * Get the configuration settings.
     *
     * @return array The configuration settings.
     */
    public function getConfig(): array {
        return $this->config->all();
    }

    /**
     * Check if the connection is established.
     *
     * @return bool True if connected, false otherwise.
     */
    public function isConnected(): bool {
        return $this->connected;
    }
}