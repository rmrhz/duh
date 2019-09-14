<?php

namespace News\Core\Repository;

abstract class Repository
{
    /**
     * PDO Instance
     * https://packagist.org/packages/lincanbin/php-pdo-mysql-class
     *
     * @var \DB
     */
    protected $db;

    /**
     * Sets the DB instance
     *
     * @param \DB
     */
    public function setDbInstance(\DB $db)
    {
        $this->db = $db;
    }
}
