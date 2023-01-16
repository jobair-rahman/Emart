<?php
session_start();
 
/**
 *
 */
class Customers
{
 
    public $con;
 
    function __construct()
    {
        include_once("Database.php");
        $db = new Database();
        $this->con = $db->connect();
    }
 
    public function getCustomers()
    {
        $query = $this->con->query("SELECT `user_id`, `first_name`, `last_name`, `email`, `mobile`, `address1`, `address2` FROM `user_info`");
        $ar = [];
        if (@$query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $ar[] = $row;
            }
            return ['status' => 202, 'message' => $ar];
        }
        return ['status' => 303, 'message' => 'no customer data'];
    }
 
 
    public function getCustomersOrder()
    {
        $query = $this->con->query("SELECT o.order_id, o.product_id, o.qty, o.trx_id, o.p_status, p.product_title, p.product_image FROM orders o JOIN products p ON o.product_id = p.product_id");
        $ar = [];
        if (@$query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $ar[] = $row;
            }
            return ['status' => 202, 'message' => $ar];
        }
        return ['status' => 303, 'message' => 'no orders yet'];
    }
 
 
}
 
 
 
if (isset($_POST["GET_CUSTOMERS"])) {
    if (isset($_SESSION['admin_id'])) {
        $c = new Customers();
        echo json_encode($c->getCustomers());
        exit();
    }
}
 
if (isset($_POST["GET_CUSTOMER_ORDERS"])) {
    if (isset($_SESSION['admin_id'])) {
        $c = new Customers();
        echo json_encode($c->getCustomersOrder());
        exit();
    }
}
 
if (isset($_GET["orderId"])) {
    if (isset($_SESSION['admin_id'])) {
        $c = new Customers();
        $status = $_GET['status'] == 1 ? "Unpaid" : "Paid";
        $c->con->query("UPDATE `orders` SET `p_status`='$status' WHERE `trx_id`=" . $_GET["orderId"]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
 
 
?>