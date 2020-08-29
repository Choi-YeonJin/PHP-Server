<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * 기본 DAO
 */

namespace DAO;
use PDO;
use PDOException;

include_once("../../application/lib/autoload.php");

class BaseDAO
{

    protected $db;
    protected $pdo;
    protected $error;
    protected $stmt;

    public function __construct()
    {
        $host = "3.23.157.65";
        $userName = "simforpay";
        $password = "simforpay0!";
        $dbName = "simforpay";
        $charset = 'utf8mb4';

        $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->pdo = new PDO($dsn, $userName, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        $this->db = $this;
    }

    /**
     * @param $query
     * @param null $params
     * @return bool
     */
    public function executeQuery($query, $params = null) {
        if ( !$this->pdo) {
            $this->error = "can't send query :: not connected DB";
            return false;
        }

        try {
            $this->stmt = $this->pdo->prepare($query);
            return $this->stmt->execute($params);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    /**
     * @param int $fetchStyle
     * @return array|bool
     */
    public function getAllResultAsArray($fetchStyle = PDO::FETCH_BOTH) {
        // FETCH_BOTH : 배열번호와 값, 배열 이름과 값이 모두 나옴 ex) result : [NAME]:'BANANA',[0]:'BANANA'
        if (empty($this->stmt)) {
            return array();
        } else {
            try {
                return $this->stmt->fetchAll($fetchStyle);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }
    }

    /**
     * @param $object
     * @param null $resultArray
     * @return array
     */
    public function getAllResultAsObject($object, $resultArray=null) {
        if(empty($resultArray)){
            $resultArray = $this->getAllResultAsArray();
        }

        $setterList = $this->getGSetters($object, "set");

        $valueObjectList = array();
        $valueObject = null;
        $className = get_class($object);

        foreach ( $resultArray as $row ) {
            if ( $valueObject === null && count(array_intersect_key($row,$setterList)) <1 ) break;
            $valueObject = new $className;

            $func = function($value, $key) use ( $setterList,$valueObject) {
                $key = strtolower($key);
                if ( isset($setterList[$key]) && method_exists($valueObject, $setterList[$key]) ) $valueObject->{$setterList[$key]}($value);
            };

            array_walk($row, $func );
            $valueObjectList[] = $valueObject;
        }

        unset($resultArray);
        return $valueObjectList;
    }

    /**
     * @param $object
     * @return bool|mixed
     */
    public function getResultAsObject($object) {
        $resultList = $this->getAllResultAsObject($object);
        return $resultList === false ? false : array_shift($resultList);
    }

    /**
     * @return int|false|null
     */
    public function getInsertId() {
        if (empty($this->pdo)) {
            return null;
        } else {
            try {
                return $this->pdo->lastInsertId();
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }
    }

    /**
     * @return int|false|null
     */
    public function getDeleteId() {
        if (empty($this->pdo)) {
            return null;
        } else {
            try {
                return $this->pdo->lastInsertId();
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                return false;
            }
        }
    }

    /**
     * @param $obj
     * @param $gs
     * @return array
     */
    protected function getGSetters($obj, $gs) {
        if ( $gs !='set' && $gs !='get' ) return array();
        $gsList = array();

        $methodList = get_class_methods(get_class($obj));
        foreach ( $methodList as $method ) {
            $pattern = sprintf('/%s([A-Z0-9].*)/',$gs);

            if ( preg_match($pattern,$method,$matches) ) {
                $columnName = strtolower(implode('_',preg_split('#([A-Z][^A-Z]*)#', $matches[1], null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY)));
                $gsList[$columnName] = $matches[0];
            }
        };

        unset($resultArray);
        return $gsList;
    }
}