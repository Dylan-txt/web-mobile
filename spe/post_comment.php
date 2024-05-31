<?php
header('Content-Type: application/json');
include 'cnx.inc.php'; // Connexion à votre base de données

$data = json_decode(file_get_contents('php://input'), true);

$monumentName = $data['monumentName'];
$userId = $data['userId'];
$commentText = $data['commentText'];

if (empty($monumentName) || empty($userId) || empty($commentText)) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$sql = "INSERT INTO commentaires (monument, idUser, commentaire, dateCommentaire) VALUES (?, ?, ?, NOW())";
$stmt = $cnx->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
    exit;
}
$stmt->bind_param("sis", $monumentName, $userId, $commentText);
$success = $stmt->execute();

echo json_encode(['success' => $success]);

$stmt->close();
$conn->close();
?>
