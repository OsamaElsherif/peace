<?php
namespace Peace\Libs\Repository\Interface;

interface  RepositoryInterface {
    public function findById(int $id, string $className): ?object;
    public function findBy(string $field, mixed $value, string $className): ?object;
    public function findAll(string $className): array;
    public function presist(object $entity): void;
    public function delete(object $entity): void;
}