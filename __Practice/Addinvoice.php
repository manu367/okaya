<?php
class BillingUI
{
    private $db;
    function __construct($db)
    {
        $this->db=$db;
    }
    public function getBillingForm($asc_code, $selected = '')
    {
        $sql = "SELECT location_code, locationname 
                FROM location_master 
                WHERE location_code = ?";

        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $asc_code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $options = '';

        while ($row = mysqli_fetch_assoc($result)) {

            $isSelected = ($row['location_code'] === $selected) ? 'selected' : '';

            $text = $row['locationname'] . ' | ' . $row['location_code'];

            $options .= '<option value="' . htmlspecialchars($row['location_code']) . '" 
                        data-tokens="' . htmlspecialchars($text) . '" 
                        ' . $isSelected . '>'
                    . htmlspecialchars($text) .
                    '</option>';
        }

        return $options;
    }
    public function getAllState($selected = '')
    {
        $sql = "SELECT stateid, state 
            FROM state_master 
            GROUP BY state 
            ORDER BY state ASC";

        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $options = '';

        while ($row = mysqli_fetch_assoc($result)) {

            $isSelected = ($row['stateid'] == $selected) ? 'selected' : '';

            $options .= '<option value="' . htmlspecialchars($row['stateid']) . '" 
                        data-tokens="' . htmlspecialchars($row['state']) . '" 
                        ' . $isSelected . '>'
                    . htmlspecialchars($row['state']) .
                    '</option>';
        }

        return $options;
    }
    public function getAllProducts($access_products, $selected = '')
    {
        if (empty($access_products)) {
            return '';
        }

        $sql = "SELECT product_id, product_name 
            FROM product_master 
            WHERE status = '1' 
            AND product_id IN ($access_products)
            ORDER BY product_name ASC";
        $result = mysqli_query($this->db, $sql);
        $options = '';
        while ($row = mysqli_fetch_assoc($result)) {

            $isSelected = ($row['product_id'] == $selected) ? 'selected' : '';

            $text = $row['product_name'] . ' | ' . $row['product_id'];

            $options .= '<option value="' . htmlspecialchars($row['product_id']) . '" 
                        data-tokens="' . htmlspecialchars($row['product_id']) . '" 
                        ' . $isSelected . '>'
                    . htmlspecialchars($text) .
                    '</option>';
        }
        return $options;
    }
    public function getBrand($selected = '')
    {
        $sql = "SELECT brand_id, brand 
            FROM brand_master 
            ORDER BY brand ASC";

        $result = mysqli_query($this->db, $sql);

        $options = '';

        while ($row = mysqli_fetch_assoc($result)) {

            $isSelected = ($row['brand_id'] == $selected) ? 'selected' : '';

            $options .= '<option value="' . htmlspecialchars($row['brand_id']) . '" 
                        data-tokens="' . htmlspecialchars($row['brand']) . '" 
                        ' . $isSelected . '>'
                    . htmlspecialchars($row['brand']) .
                    '</option>';
        }

        return $options;
    }

    public function getModal($brand, $productid, $selected = '')
    {
        if (empty($brand) || empty($productid)) {
            return '';
        }

        $sql = "SELECT model_id, model
            FROM model_master 
            WHERE brand_id = ? 
            AND product_id = ?
            ORDER BY model ASC";

        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $brand, $productid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $options = '';

        while ($row = mysqli_fetch_assoc($result)) {

            $isSelected = ($row['model_id'] == $selected) ? 'selected' : '';

            $options .= '<option value="' . htmlspecialchars($row['model_id']) . '" 
                        data-tokens="' . htmlspecialchars($row['model']) . '" 
                        ' . $isSelected . '>'
                    . htmlspecialchars($row['model']) .
                    '</option>';
        }
        return $options;
    }

    public function getPartCodeOptions($modelBilling, $ascCode, $dupPart = '', $selected = '')
    {
        if (empty($modelBilling) || empty($ascCode)) {
            return '';
        }

        $options = '';

        // Duplicate part condition
        $dupCondition = '';
        if (!empty($dupPart)) {
            $dupCondition = " AND partcode NOT IN ('" . mysqli_real_escape_string($this->db, $dupPart) . "') ";
        }

        $modelBilling = mysqli_real_escape_string($this->db, $modelBilling);
        $ascCode      = mysqli_real_escape_string($this->db, $ascCode);

        $sql = "
        SELECT partcode, part_name, part_category
        FROM partcode_master
        WHERE model_id LIKE '%$modelBilling%'
        AND partcode IN (
            SELECT partcode 
            FROM client_inventory 
            WHERE location_code = '$ascCode'
            AND okqty > 0
        )
        $dupCondition
        GROUP BY partcode
        ORDER BY part_name
    ";
        $res = mysqli_query($this->db, $sql);

        if ($res && mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

                $isSelected = ($row['partcode'] == $selected) ? 'selected' : '';

                $options .= '<option 
                            value="' . htmlspecialchars($row['partcode']) . '" 
                            data-tokens="' . htmlspecialchars($row['partcode'] . '|' . $row['part_name']) . '" 
                            ' . $isSelected . '>'
                    . htmlspecialchars(
                        $row['partcode'] . ' - ' .
                        $row['part_name'] . ' (' . $row['part_category'] . ')'
                    )
                    . '</option>';
            }
        }

        return $options;
    }



    public function getSerial(){}
    public function getQuantity(){}
    public function getPrice(){}
    public function getcost(){}
    public function getDiscount(){}

    public function getValudAfterDIscount(){}
    public function getIGSTPercentae(){}
    public function getIGSTAMt(){}
    public function total(){}
}
?>

