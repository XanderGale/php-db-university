<?php

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/Department.php';

$sql = $connection->prepare('SELECT * FROM departments WHERE id = ?');
$sql->bind_param('d', $id);
$id = $_GET['id'];
$sql->execute();
$result = $sql->get_result();

if ($result && $result->num_rows > 0) {
    $departments = [];
    while($row = $result->fetch_assoc() ){
        $department = new Department();
        $department->id = $row['id'];
        $department->name = $row['name'];
        $department->website = $row['website'];
        $department->phone = $row['phone'];
        $department->email = $row['email'];
        $department->address = $row['address'];
        $departments[] = $department;
    }
} elseif ($result && $result->num_rows == 0) {
    echo 'No results found.';
} else {
    echo 'Query error.';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Details</title>
</head>
<body>
    <?php foreach($departments as $department) { ?>
        <div>
            <h2><?php echo $department->name; ?></h2>
            <ul>
                <li><?php echo $department->address; ?></li>
                <li><?php echo $department->phone; ?></li>
                <li><?php echo $department->email; ?></li>
                <li><a href="https://<?php echo $department->website; ?>"><?php echo $department->website; ?></a></li>
            </ul>
            <br>
            <a href="index.php">Ritorna alla pagina principale</a>
        </div>
    <?php } ?>
</body>
</html>