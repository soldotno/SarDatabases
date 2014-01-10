<?php

namespace SarDatabases;

class SarMongo Extends \MongoClient
{
    public $conn;
    protected $db;
    protected $collection;
    private $systemName;



    public function __construct($env, $systemName, $collectionName = "db")
    {
        //$host = $this->getServiceLocator()->get('config')["sardatabases"]["host"];


        $host = $this->getConfig()["sardatabases"]["host"][$this->getConfig()["sardatabases"]["environment"]];

        if (empty($env) || empty($systemName)) {
            return false;
        }

        switch ($env) {
            default:
                $this->conn = new \MongoClient($host);
                $this->db = $this->conn->$systemName;
                $this->collection = $this->db->$collectionName;
                break;

        }
        return $this->conn;
    }

    public function count()
    {
        return $this->collection->count();
    }

    public function getConfig()
    {
        return include (dirname(__DIR__ )). '/../config/module.config.php';
    }

    /**
     * Inserts array
     * @param $array
     * @return mixed
     */
    public function insertOne($array = array('x' => 1))
    {
        $this->_insert_no_cow($this->collection, $array);
        return (string)$array["_id"];
    }

    /**
     * Wrapping function to prevent triggering copy-on-write in order to make the _id available
     * @param $collection
     * @param $document
     */
    private function _insert_no_cow($collection, $document)
    {
        $collection->insert($document);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function find($array)
    {
        return $this->collection->find($array);
    }

    /**
     * @param $array
     * @return mixed
     */
    public function delete($array)
    {
        return $this->collection->remove($array);
    }

    /**
     * Deletes a MongoId from the mongo database
     * @param $mongoId
     * @return mixed
     */
    public function deleteOne($mongoId)
    {
        return $this->collection->remove(array("_id" => new \MongoId($mongoId)));
    }

    /**
     * @param $mongoId
     * @param $array
     * @return mixed
     */
    public function updateOne($mongoId, $array)
    {
        $this->_modify_no_cow($this->collection, $mongoId, $array);
        return $array;
    }

    /**
     * Wrapping function to prevent triggering copy-on-write in order to make the _id available
     * @param $collection
     * @param $mongoId
     * @param $array
     */
    private function _modify_no_cow($collection, $mongoId, $array)
    {
        //$collection->findAndModify(array("_id"=>new \MongoId($mongoId)), $array);
        $collection->update(array("_id" => new \MongoId($mongoId)), $array);
    }

}
