<?php
header('Content-Type: application/json; charset=utf-8');
$db = new PDO('sqlite:/var/www/html/db/restaurant.db');
$action = $_GET['action'] ?? 'menu';

if ($action === 'menu') {
    $stmt = $db->query("SELECT * FROM menu");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
} elseif ($action === 'order') {
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $db->prepare("INSERT INTO orders (customer_name) VALUES (?)");
    $stmt->execute([$data['customer_name']]);
    $orderId = $db->lastInsertId();
    foreach ($data['items'] as $item) {
        $stmt = $db->prepare("INSERT INTO order_items (order_id, menu_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$orderId, $item['menu_id'], $item['quantity']]);
    }
    echo json_encode(['status' => 'ok', 'order_id' => $orderId]);
}
?>