<?php
/**
 * Class DBService
 *
 * @package  ${NAMESPACE}
 * @author   canngo
 *
 */

namespace Est\TodoApp\ServiceProviders;

class DBService extends \SQLite3
{
    function __construct($dbPath)
    {
        $this->open($dbPath);
    }

    public function __destruct()
    {
        $this->close();
    }


}
