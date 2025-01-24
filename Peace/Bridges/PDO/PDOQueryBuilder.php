<?php
namespace Peace\Bridges\PDO;

use PDO;
use Peace\Libs\Database\Abstract\AbstractQueryBuilder;
use Peace\Libs\Database\Interface\QueryBuilderInterface;

class PDOQueryBuilder extends AbstractQueryBuilder implements QueryBuilderInterface {
    private ?PDO $pdo;

    public function __construct(string $table, PDO $pdo) {
        parent::__construct($table);
        $this->pdo = $pdo;
    }
    
    public function getSQL(): string {
        $sql = ' SELECT ' . implode(', ', $this->column) . " FROM " . $this->table;

        if (!empty($this->where)) {
            $whereClauses = [];
            foreach ($this->where as $condition) {
                if (is_array($condition) && count($condition) == 4  && $condition[0] == 'OR') {
                    // Handle OR condition
                    $whereClauses[] = "{$condition[1]} {$condition[2]} ?";
                } else {
                    $whereClauses[] = "{$condition[0]} {$condition[1]} ?";
                }
            }
            $sql .= " WHERE " . implode(' AND ', $whereClauses);
        }

        if ($this->orderBy !== '') {
            $sql .= " ORDER BY " . $this->orderBy . " " . $this->orderDirection;
        }

        if ($this->limit > 0) {
            $sql .= " LIMIT " . $this->limit;
            if ($this->offset > 0) {
                $sql .= " OFFSET " . $this->offset;
            }
        }

        return $sql;
    }

	public function getParams(): array {
        return $this->params;
    }
}