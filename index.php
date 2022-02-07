<?php

require_once __DIR__ . '/database.php';

$sql = 'SELECT * FROM departments';
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $departments = [];
    while($row = $result->fetch_assoc() ){
        $department = new Department();
        $department->id = $row['id'];
        $department->name = $row['name'];
        $department->website = $row['website'];
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
    <title>University</title>
</head>
<body>
    <?php foreach($departments as $department) { ?>
        <div>
            <h2><?php echo $department->name; ?></h2>
            <ul>
                <li><a href="department-details.php?id=<?php echo $department->id ?>">Mostra dettagli</a></li>
            </ul>
        </div>
    <?php } ?>
</body>
</html>