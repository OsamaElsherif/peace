<?php
namespace Peace\Bridges\Repository;

use Exception;
use PDO;
use PDOException;
use Peace\Bridges\PDO\PDOQueryBuilder;
use Peace\Factories\ConnectionFactory;
use Peace\Libs\Config;
use Peace\Libs\Repository\Abstract\AbstractRepository;
use Peace\Libs\Repository\Interface\RepositoryInterface;

class PeaceRepository extends AbstractRepository implements RepositoryInterface
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    public function findById(int $id, string $className): ?object
    {
        return $this->entityManager->find($className, $id);
    }

    public function findBy(string $field, mixed $value, string $className): ?object
    {
        $connection = ConnectionFactory::createConnection($this->config);
        $connection->connect();
        $queryBuilder = new PDOQueryBuilder($this->getTableNameFromClassName($className), $connection->getResource());

        $queryBuilder->select()
            ->where($field, '=', $value);

        $sql = $queryBuilder->getSQL();
        $params = $queryBuilder->getParams();

        
        try {
            $stmt = $connection->getResource()->prepare($sql);
            $stmt->execute($params);
            $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
            $entity = $stmt->fetch();
            return $entity ?: null;
        } catch (PDOException $e) {
            throw new Exception("Error finding entity: " . $e->getMessage());
        }
    }

    public function findAll(string $className): array
    {
        return $this->entityManager->getAll($className);
    }

    public function presist(object $entity): void
    {
        $this->entityManager->persist($entity);
    }

    public function delete(object $entity): void
    {
        $this->entityManager->remove($entity);
    }
}