<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
        SELECT id, name, done
        FROM items
        WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" >
  
</head>
<body>
    <div class="list">
        <h1 class="header">To do.</h1>
        
        <?php if(!empty($items)): ?>
        <ul class="items">
            <?php foreach($items as $item):?>
                <li>
                    <span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']; ?></span>
                    <?php if(!$item['done']): ?>
                        <a href="mark.php?as=done&item=<?php echo $item ['id']; ?>" class="done-button">Marcar como hecho</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>No haz agregado elementos aún</p>
        <?php endif; ?>

        <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Escribe una nueva tarea..." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>
    </div>
    
</body>
</html>