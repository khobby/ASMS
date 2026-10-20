<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
class NotificationController {
	public function mark_read() {
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success'=>false]); exit; }
		if (empty($_POST['id'])) { echo json_encode(['success'=>false]); exit; }
		$id = (int)$_POST['id'];
		$db = Database::getInstance()->getConnection();
		$stmt = $db->prepare('UPDATE notifications SET is_read=1 WHERE id=?');
		$stmt->execute([$id]);
		echo json_encode(['success'=>true]);
	}
}
