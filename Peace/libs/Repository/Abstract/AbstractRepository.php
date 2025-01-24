<?php
namespace Peace\Libs\Repository\Abstract;

use Peace\Factories\ConnectionFactory;
use Peace\Libs\Config;
use Peace\Libs\Database\Interface\ConnectionInterface;
use Peace\Libs\Database\Interface\EntityManagerInterface;
use Peace\Libs\Repository\Interface\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    protected EntityManagerInterface $entityManager;
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $connection = ConnectionFactory::createConnection($config);
        $this->entityManager = ConnectionFactory::createEntityManager($connection, $config);
    }

    abstract public function findById(int $id, string $className): ?object;
    abstract public function findBy(string $field, mixed $value, string $className): ?object;
    abstract public function findAll(string $className): array;
    abstract public function presist(object $entity): void;
    abstract public function delete(object $entity): void;

    protected function getTableNameFromClassName(string $className): string
    {
        $tableName = substr($className, strrpos($className, '\\') + 1);
        return strtolower($tableName) . 's';
    }
}