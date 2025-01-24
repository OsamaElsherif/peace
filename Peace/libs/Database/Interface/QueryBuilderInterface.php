<?php
namespace Peace\Libs\Database\Interface;

/**
 * Interface QueryBuilder
 *
 * Provides an interface for building SQL queries.
 */
interface QueryBuilderInterface {
    /**
     * Select columns from a table.
     *
     * @param array $columns The columns to select.
     * @return QueryBuilderInterface
     */
    public function select(array $columns = ['*']): QueryBuilderInterface;

    /**
     * Specify the table to select from.
     *
     * @param string $table The table name.
     * @return QueryBuilderInterface
     */
    public function from(string $table): QueryBuilderInterface;

    /**
     * Add a WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function where(string $column, string $operator, $value): QueryBuilderInterface;

    /**
     * Add an AND WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function andWhere(string $column, string $operator, $value): QueryBuilderInterface;

    /**
     * Add an OR WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function orWhere(string $column, string $operator, $value): QueryBuilderInterface;

    /**
     * Add an ORDER BY clause to the query.
     *
     * @param string $column The column name.
     * @param string $direction The sort direction (ASC or DESC).
     * @return QueryBuilderInterface
     */
    public function orderBy(string $column, string $direction = 'ASC'): QueryBuilderInterface;

    /**
     * Add a LIMIT clause to the query.
     *
     * @param int $limit The number of rows to return.
     * @param int $offset The number of rows to skip.
     * @return QueryBuilderInterface
     */
    public function limit(int $limit, int $offset = 0): QueryBuilderInterface;

    /**
     * Get the SQL query string.
     *
     * @return string
     */
    public function getSQL(): string;

    /**
     * Get the parameters for the query.
     *
     * @return array
     */
    public function getParams(): array;
}