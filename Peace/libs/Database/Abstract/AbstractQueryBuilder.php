<?php
namespace Peace\Libs\Database\Abstract;

use Peace\Libs\Database\Interface\QueryBuilderInterface;

/**
 * Class AbstractQueryBuilder
 *
 * Provides a base implementation for building SQL queries.
 */
abstract class AbstractQueryBuilder implements QueryBuilderInterface {
    /**
     * @var string The table name.
     */
    protected string $table;

    /**
     * @var array The columns to select.
     */
    protected array $column = ['*'];

    /**
     * @var array The WHERE clauses.
     */
    protected array $where = [];

    /**
     * @var string The column to order by.
     */
    protected string $orderBy = '';

    /**
     * @var string The direction to order by (ASC or DESC).
     */
    protected string $orderDirection = 'ASC';

    /**
     * @var int The number of rows to return.
     */
    protected int $limit = 0;

    /**
     * @var int The number of rows to skip.
     */
    protected int $offset = 0;

    /**
     * @var array The parameters for the query.
     */
    protected array $params = [];

    /**
     * AbstractQueryBuilder constructor.
     *
     * @param string $table The table name.
     */
    public function __construct(string $table) {
        $this->table = $table;
    }

    /**
     * Select columns from a table.
     *
     * @param array $column The columns to select.
     * @return QueryBuilderInterface
     */
    public function select(array $column = ['*']): QueryBuilderInterface {
        $this->column = $column;
        return $this;
    }

    /**
     * Specify the table to select from.
     *
     * @param string $table The table name.
     * @return QueryBuilderInterface
     */
    public function from(string $table): QueryBuilderInterface {
        $this->table = $table;
        return $this;
    }

    /**
     * Add a WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function where(string $column, string $operator, $value): QueryBuilderInterface {
        $this->where[] = [$column, $operator, $value];
        $this->params[] = $value;
        return $this;
    }

    /**
     * Add an AND WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function andWhere(string $column, string $operator, $value): QueryBuilderInterface {
        return $this->where($column, $operator, $value);
    }

    /**
     * Add an OR WHERE clause to the query.
     *
     * @param string $column The column name.
     * @param string $operator The comparison operator.
     * @param mixed $value The value to compare against.
     * @return QueryBuilderInterface
     */
    public function orWhere(string $column, string $operator, $value): QueryBuilderInterface {
        $this->where[] = ['OR', $column, $operator, $value];
        $this->params[] = $value;
        return $this;
    }

    /**
     * Add an ORDER BY clause to the query.
     *
     * @param string $column The column name.
     * @param string $direction The sort direction (ASC or DESC).
     * @return QueryBuilderInterface
     */
    public function orderBy(string $column, string $direction = 'ASC'): QueryBuilderInterface {
        $this->orderBy = $column;
        $this->orderDirection = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        return $this;
    }

    /**
     * Add a LIMIT clause to the query.
     *
     * @param int $limit The number of rows to return.
     * @param int $offset The number of rows to skip.
     * @return QueryBuilderInterface
     */
    public function limit(int $limit, int $offset = 0): QueryBuilderInterface {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }
}