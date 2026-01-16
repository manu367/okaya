<?php
class BatterySerialUploader{
    private $conn;
    private $response=[];
    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }
    public function checkModel():bool
    {
        return true;
    }
    public function insertData():bool
    {
        return false;
    }
    private function setresponse($data,$isAction)
    {
        array_push($this->response,$data,$isAction);
    }
    public function getResponse():json{
        return json_encode($this->response);
    }
}

?>