<?php
$arr  = [1,2,3,4,5,6,7,8,9];
$arr1 = [10,2,3,4,5,6,7,8,9];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Status Check</title>
    <style>
        .success { color: green; font-weight: bold; }
        .failed  { color: red; font-weight: bold; }
    </style>
</head>
<body>

<h2>Array Status Result</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Value</th>
        <th>Status</th>
    </tr>

    <?php
    for ($i = 0; $i < count($arr); $i++) {

        if (in_array($arr[$i], $arr1)) {
            $status = "success";
            $class  = "success";
        } else {
            $status = "failed";
            $class  = "failed";
        }
        ?>
        <tr>
            <td><?php echo $arr[$i]; ?></td>
            <td class="<?php echo $class; ?>">
                <?php echo $status; ?>
            </td>
        </tr>
        <?php
    }
    ?>

</table>

</body>
</html>
