<?php
header('Content-Type: application/json');
include 'cnx.inc.php'; // Connexion à votre base de données

$monument = $_GET['monument'];

if (empty($monument)) {
    echo json_encode(['error' => 'Monument not specified']);
    exit;
}

$sql = "SELECT * FROM commentaires WHERE monument = ?";
$stmt = $cnx->prepare($sql);
if (!$stmt) {
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
    exit;
}
$stmt->bind_param("s", $monument);
$stmt->execute();
$result = $stmt->get_result();

$comments = array();
while($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode($comments);

$stmt->close();
$conn->close();
?>
