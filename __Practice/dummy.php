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

