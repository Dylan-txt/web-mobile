<?php
header('Content-Type: application/json');
include 'cnx.inc.php';

$monument = $_GET['monument'];

$sql = "SELECT * FROM commentaires WHERE monument = ?";
$stmt = $cnx->prepare($sql);
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
