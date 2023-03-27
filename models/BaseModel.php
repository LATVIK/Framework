<?php

namespace models;

use service\DataBase;

abstract class BaseModel
{
    protected ?int $id = null;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->{$camelCaseName} = $value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function save(): void
    {
        $properties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($properties);
        } else {
            $this->insert($properties);
        }
    }

    public function delete(): void
    {
        $db = DataBase::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    public static function findAll($search = ''): ?array
    {
        $db = DataBase::getInstance();
        $condition = '';
        if ($search) {
            $condition = " WHERE title LIKE '%{$search}%'";
        }
        $entities = $db->query('SELECT * FROM ' . static::getTableName()
            . $condition
            . ' ORDER by id DESC;', [], static::class);

        return $entities ?? null;
    }

    public static function findByColumn(string $columnName, $value, $search = ''): ?array
    {
        $db = DataBase::getInstance();
        $condition = '';
        if ($search) {
            $condition = " AND title LIKE '%{$search}%'";
        }
        $entities = $db->query(
            'SELECT * FROM '
            . static::getTableName() . ' WHERE '
            . $columnName . '= :value '
            . $condition . 'ORDER BY id DESC;',
            [':value' => $value],
            static::class
        );

        return $entities ?? null;
    }

    public static function findOneByColumn(string $columnName, $value): ?static
    {
        $db = DataBase::getInstance();
        $entity = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE ' . $columnName . '= :value LIMIT 1;',
            [':value' => $value],
            static::class
        );
        if ($entity) {
            return $entity[0];
        }

        return null;
    }

    public static function findById(int $id): ?static
    {
        return static::findOneByColumn('id', $id);
    }

    abstract protected static function getTableName(): string;

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/[A-Z]/', '_$0', $source));     // source recommends  '/(?<!^)[A-Z]/'
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderS = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderS] = $this->{$propertyName};
        }

        return $mappedProperties;
    }

    private function update(array $properties): void
    {
        $sql = 'UPDATE '
            . static::getTableName()
            . ' SET ' . implode('= ? , ', array_keys($properties)) . '= ?'
            . ' WHERE id = ' . $this->id;
        $db = DataBase::getInstance();
        $db->query($sql, array_values($properties), static::class);
    }

    private function insert(array $properties): void
    {
        $properties = array_filter($properties);

        $sql = 'INSERT INTO '
            . static::getTableName()
            . ' (' . implode(', ', array_keys($properties))
            . ') VALUES (' . str_repeat(' ? ,', count($properties) - 1) . '? );';

        $db = DataBase::getInstance();
        $db->query($sql, array_values($properties), static::class);
    }
}
