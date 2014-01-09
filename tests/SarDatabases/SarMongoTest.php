<?php
/**
 * Unit Test Example
 *
 * @author Sven Anders Robbestad <robbestad@gmail.com>
 */
namespace SarDatabases\Tests;

require_once __DIR__ . '/../../src/SarDatabases/SarMongo.php';

use SarDatabases\SarMongo;

    /**
     * ParserTest class test case
     *
     * @author Sven Anders Robbestad <robbestad@gmail.com>
     */
class SarmongoTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Can Connect to database
     */
    public function testCanConnectToDatabase()
    {
            $mongoconn = new SarMongo("prod", "_test");
            $this->assertNotNull($mongoconn);
    }

    /**
     * Can Manipulate Rows
     * Adds a string
     * Modifies it
     * Deletes it
     */
    public function testCanManipulateRows()
    {
        $mongoconn = new SarMongo("prod", "_test");
        $mongoId =$mongoconn->insertOne();

        //  var_dump((string)$result); //MongoID object to string
        // Assert that the entry is inserted
        $this->assertNotEmpty((string)$mongoId);

        //Assert that we can modify the entry
        $this->assertEquals("6", $mongoconn->updateOne($mongoId, array("x"=>6))['x']);

        // Assert that we can delete this entry
        $drop =$mongoconn->deleteOne($mongoId);
        $this->assertNotEmpty((string)$drop);
    }

    public function testCanInsertSingleElement()
    {
        $mongoconn = new SarMongo("prod", "_test");
        $mongoId =$mongoconn->insertOne(array("sar"=>"var her"));
        $this->assertNotEmpty((string)$mongoId);
    }


    public function testCanQueryTheDatabase()
    {
        $mongoconn = new SarMongo("prod", "_test");
        $cursor =$mongoconn->find(array("sar"=>"var her"));
        $array = iterator_to_array($cursor);
        foreach($array as $val)
            $this->assertEquals($val["sar"], "var her");
    }

    public function testCanRemoveElementsWithQuery()
    {
        $mongoconn = new SarMongo("prod", "_test");
        $mongoId =$mongoconn->delete(array("sar"=>"var her"));
        $this->assertNotEmpty((string)$mongoId);
    }


}
