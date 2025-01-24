<?php
namespace Peace\Factories;

use Peace\Bridges\ORM\PeaceORM;
use Peace\Bridges\PDO\PDOConnection;
use Peace\Bridges\EntityManager\PeaceEntityManager;
use Peace\Libs\Config;
use Peace\Libs\Database\Interface\ConnectionInterface;
use Peace\Libs\Database\Interface\EntityManagerInterface;

class ConnectionFactory {

    /**
     * Creates a database connection based on the provided configuration.
     *
     * @param Config $config The database configuration array.
     *
     * @return ConnectionInterface An instance of a class implementing ConnectionInterface.
     * @throws \Exception If the connection type is not supported.
     */
    public static function createConnection(Config $config): ConnectionInterface {
        $connectionType = strtoupper($config->get('connection') ?? 'PDO'); // Default to PDO if not specified

        switch ($connectionType) {
            case 'PDO':
                return new PDOConnection($config);
            // You can add more cases here for other connection types (ODBC, etc.)
            default:
                throw new \Exception("Unsupported connection type: " . $connectionType);
        }
    }

    /**
     * Creates an entity manager based on the connection and configuration.
     *
     * @param ConnectionInterface $connection The database connection.
     * @param Config $config The database configuration array.
     *
     * @return EntityManagerInterface An instance of a class implementing EntityManagerInterface.
     * @throws \Exception If the ORM is not supported.
     */
    public static function createEntityManager(ConnectionInterface $connection, Config $config): EntityManagerInterface {
        $orm = strtoupper($config->get('orm') ?? 'BASIC'); // Default to basic if not specified

        switch ($orm) {
            case 'PEACEORM':
                return new PeaceORM($connection);
            case 'PEACEEM':
                return new PeaceEntityManager($connection);
            default:
                throw new \Exception("Unsupported ORM: " . $orm);
        }
    }
}