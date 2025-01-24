<?php
namespace Peace\Bridges\ORM;

use PDO;
use PDOException;
use ReflectionClass;
use ReflectionProperty;

use Peace\Libs\CoreORM\Abstract\AbstractCoreORM;
use Peace\Libs\Database\Interface\EntityManagerInterface;
use Peace\Libs\Database\Interface\ConnectionInterface;

class PeaceORM extends AbstractCoreORM implements EntityManagerInterface {
    public function __construct(ConnectionInterface $connection) {
        parent::__construct($connection);
    }

    public function persist(object $entity): void {
        $reflection = new ReflectionClass($entity);
        $tableName = $this->getTableName($entity);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $fields = [];
        $values = [];
        $params = [];
        $idValue = null;

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($entity);

            if ($propertyName === 'id') {
                $idValue === $propertyValue;
                continue;
            }

            $fields = $propertyName;
            $params = '?';
            $values = $propertyValue;
        }

        if ($idValue === null) {
            // perform insert
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $tableName,
                implode(', ', $fields),
                implode(', ', array_fill(0, count($fields), '?')));
        } else {
            // perform update
            $setClauses = [];

            foreach ($fields as $field) {
                $setClauses[] = "$field = ?";
            }

            $sql = sprintf(
                'UPDATE %s SET %s WHERE id = ?',
                $tableName,
                implode(', ', $setClauses));
            
            $values[] = $idValue;
        }

        try {
            $this->connection->connect();
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute($values);
            if ($idValue === null) {
                $entity->id = $this->connection->getResource()->lastInsertId();
            }
        } catch (PDOException $e) {
            throw new \Exception("PDO Connection failed: " . $e->getMessage());
        }
    }

    public function remove(object $entity): void  {
        $tableName = $this->getTableName($entity);
        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $idValue = null;
        
        foreach ($properties as $property) {
            if ($property->getName() === 'id') {
                $idValue = $property->getValue($entity);
                break;
            }
        }

        if (!$idValue) {
            throw new \Exception("CoreORM remove opertation error: Entity has no id");
        }

        $sql = sprintf("DELETE FROM %s WHERE id = ?", $tableName);
        try {
            $this->connection->connect();
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute([$idValue]);
        } catch (PDOException $e) {
            throw new \Exception("CoreORM remove operation error: " . $e->getMessage());
        }
    }

    public function find(string $className, mixed $id): ?object {
        $tableName = $this->getTableNameFromClassName($className);
        $sql = sprintf("SELECT * FROM %s WHERE id = ?", $tableName);
         try {
            $this->connection->connect();
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute([$id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
            $entity = $stmt->fetch();

            return $entity ?: null;
        } catch (PDOException $e) {
            throw new \Exception("CoreORM find entity operation error: " . $e->getMessage());
        }
    }

    public function getAll(string $className): array {
        $tableName = $this->getTableNameFromClassName($className);

        $sql = sprintf('SELECT * FROM %s', $tableName);

        try {
            // die(var_dump($this->connection->getResource()));
            $this->connection->connect();
            $stmt = $this->connection->getResource()->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, $className);
            return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
        } catch (PDOException $e) {
            throw new \Exception("Error getting all entities: " . $e->getMessage());
        }
    }
}