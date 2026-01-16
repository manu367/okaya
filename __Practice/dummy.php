<?php
//$name="manu pathak";
////var_dump(__DIR__ ."/InvalidRequestException.php");exit();
//require_once("../_exceptions/SuperException.php");
//$arr = ["Add","Edit"];
//$op  = $_REQUEST['op'] ?? null;
//
//if (!in_array($op, $arr)) {
//    showError();exit();
//}
//
//if ($_SERVER["REQUEST_METHOD"] !== "GET" && $_SERVER["REQUEST_METHOD"] !== "POST") {
//    showError();exit();
//}
//if (!array_key_exists('token', $_POST)) {
//    showError("Security token missing");
//}

?>
<?php
$tablename="allowed_table";
$sql= "CREATE TABLE IF NOT EXISTS $tablename (
    all_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    col_allowed VARCHAR(25) NOT NULL,
    all_filename VARCHAR(50) NOT NULL,
    allowed INT
);
";
$check = mysqli_query($link1, "SHOW TABLES LIKE '$tablename'");
if (mysqli_num_rows($check) > 0) {
    echo "Table already exists 🧱";
} else {
    echo "Table does NOT exist 🌱";
}
?>
<script>
    class Node{
        constructor(data) {
            this.data=data;
            this.behaviour=null;
        }
    }
    class Linkedlist{
        constructor() {
            this.head=null;
        }
        addNode(data){
            const node=new Node(data);
            if(this.head===null)this.head=node;
            let temp=this.head;
            while (temp.next!==null){
                temp=temp.behaviour;
            }
            temp.behaviour=node;
        }
        print() {
            let temp = this.head;
            while (temp !== null) {
                console.log(temp.data);
                temp = temp.next;
            }
        }
    }
</script>
<?php
$auth = $_SERVER['HTTP_MANU_AUTH_PAGE'] ?? null;
$prev = $_SERVER['HTTP_PREVIOUS_HEADER'] ?? null;
$data = [
    "name" => null
];
$a=5;$b=3;
if($a&$b){
    echo "true";
}else{
    echo "false";
}
if($a<<1==10){
    echo "true";
}
else{
    echo "false";
}
?>
<?=$auth?>
<?=$prev?>
<h1>helllo</h1>
<script>

</script>

