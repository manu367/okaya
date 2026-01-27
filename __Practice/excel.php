<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=admin_user_report-".date("d-m-Y_H-i-s").".xls");
?>
<table style="border-collapse:collapse;width:100%;font-family:Calibri,Arial,sans-serif;font-size:14px;color:#000;">

    <tr style="background:#e7f3ff;font-weight:bold;">
        <td style="border:1px solid #b7cce1;padding:8px;">No.</td>
        <td style="border:1px solid #b7cce1;padding:8px;">Name</td>
        <td style="border:1px solid #b7cce1;padding:8px;">Skill</td>
        <td style="border:1px solid #b7cce1;padding:8px;">City</td>
        <td style="border:1px solid #b7cce1;padding:8px;">Rating</td>
    </tr>

    <tr>
        <td style="border:1px solid #d0d7de;padding:6px;">1</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Aarav</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Web Design</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Delhi</td>
        <td style="border:1px solid #d0d7de;padding:6px;">4</td>
    </tr>

    <tr style="background:#f9fbfd;">
        <td style="border:1px solid #d0d7de;padding:6px;">2</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Riya</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Content Writing</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Mumbai</td>
        <td style="border:1px solid #d0d7de;padding:6px;">5</td>
    </tr>

    <tr>
        <td style="border:1px solid #d0d7de;padding:6px;">3</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Kabir</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Data Analysis</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Pune</td>
        <td style="border:1px solid #d0d7de;padding:6px;">4</td>
    </tr>

    <tr style="background:#f9fbfd;">
        <td style="border:1px solid #d0d7de;padding:6px;">4</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Ananya</td>
        <td style="border:1px solid #d0d7de;padding:6px;">UI/UX Design</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Bengaluru</td>
        <td style="border:1px solid #d0d7de;padding:6px;">5</td>
    </tr>

    <tr>
        <td style="border:1px solid #d0d7de;padding:6px;">5</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Rohit</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Digital Marketing</td>
        <td style="border:1px solid #d0d7de;padding:6px;">Jaipur</td>
        <td style="border:1px solid #d0d7de;padding:6px;">4</td>
    </tr>
</table>

