<?php
require 'doctype.php';
require 'functions/checkAuth.php';

$pdo = require_once 'config/connect.php';

$user = $pdo->prepare("SELECT * FROM users WHERE `id` = :id");
$user->execute(['id' => $_COOKIE['userId']]);
$user = $user->fetch(PDO::FETCH_ASSOC);

$task = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :userId");
$task->execute(['userId' => $user['id']]);
$task = $task->fetchAll();

?>

<div class="shadow">
    <header class="d-flex flex-wrap justify-content-center p-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <span class="fs-4">TaskList</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link" aria-current="page">
                    <?php echo htmlspecialchars($user['login']) ?></a></li>
            <form method="post" action="functions/logout.php">
                <button type="submit" class="btn btn-primary">Выйти</button>
            </form>
        </ul>
    </header>
</div>
<div class="container col-lg-5 d-flex flex-column">
    <h4 class="text-center">Task list</h4>
    <div class="mt-3">
        <form method="post" action="functions/taskAddition.php" class="d-flex justify-content-between">
            <div class="col-lg-8">
                <input name="task" type="text" placeholder="Enter text..." class="form-control col-lg-3 p-2">
            </div>
            <button type="submit" class="btn btn-dark mx-2">Add Task</button>
        </form>
        <div class="d-flex mt-2">
            <form method="post" action="functions/taskRemoval.php">
                <button class="btn btn-danger">Remove All</button>
            </form>
            <form method="post" action="functions/taskReadiness.php">
                <button class="btn btn-success mx-3">Ready All</button>
            </form>
        </div>
    </div>
    <div>
        <?php
        if ($task !== null) {
            foreach ($task as $value) {
                ?>
                <div class="d-flex justify-content-between border-top border-secondary-subtle p-2 mt-2">
                    <div>
                        <p class="fs-3"><?php echo htmlspecialchars($value['description']) ?></p>
                        <div class="d-flex">
                            <form method="post" action="functions/taskReadiness.php">
                                <button class="btn border border-secondary" name="taskId" value="<?= $value['id'] ?>">
                                    <?php
                                    if (!$value['status']) {
                                        printf('Ready');
                                    } else {
                                        printf('Unready');
                                    }
                                    ?>
                                </button>
                            </form>
                            <form method="post" action="functions/taskRemoval.php" class="mx-2">
                                <button class="btn border border-secondary" name="taskId" value="<?= $value['id'] ?>">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <?php
                        if (!$value['status']) {
                            printf('<button class="btn border border-danger border-4 rounded-circle p-5"></button>');
                        } else {
                            printf('<button class="btn border border-success border-4  rounded-circle p-5"></button>');
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
