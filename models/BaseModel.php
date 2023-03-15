<?php

namespace models;

use service\DataBase;

abstract class BaseModel
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    public static function findAll(): array
    {
        $db = DataBase::getInstance();
        return $db->query('SELECT * FROM ' . static::getTableNAme() . ' ORDER by id DESC;', [], static::class);
    }

    public static function findById(int $id): ?self
    {
        $db = DataBase::getInstance();
        $entities = $db->query(
            'SELECT * FROM ' . static::getTableNAme() . ' WHERE id=:id ORDER BY id DESC;',
            ['id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }
}
