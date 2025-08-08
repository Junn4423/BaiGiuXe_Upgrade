<?php
$tasks = [
    ['id' => 1, 'title' => 'Phân tích yêu cầu', 'status' => 'backlog'],
    ['id' => 2, 'title' => 'Thiết kế giao diện', 'status' => 'todo'],
    ['id' => 3, 'title' => 'Phát triển chức năng', 'status' => 'in_progress'],
    ['id' => 4, 'title' => 'Kiểm thử', 'status' => 'review'],
    ['id' => 5, 'title' => 'Triển khai', 'status' => 'done']
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dự án</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }
        .container {
            width: 90%;
            margin: auto;
            text-align: center;
        }
        .board {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 20px;
        }
        .column {
            flex: 1;
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            min-height: 250px;
        }
        .column h3 {
            background: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .task {
            background: #ffc107;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            cursor: grab;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Quản lý Dự án - Kéo Thả</h2>
        <div class="board">
            <div class="column" id="backlog">
                <h3>Backlog</h3>
                <?php foreach ($tasks as $task) {
                    if ($task['status'] === 'backlog') {
                        echo "<div class='task' draggable='true' data-id='{$task['id']}'>{$task['title']}</div>";
                    }
                } ?>
            </div>
            <div class="column" id="todo">
                <h3>Chưa Bắt Đầu</h3>
                <?php foreach ($tasks as $task) {
                    if ($task['status'] === 'todo') {
                        echo "<div class='task' draggable='true' data-id='{$task['id']}'>{$task['title']}</div>";
                    }
                } ?>
            </div>
            <div class="column" id="in_progress">
                <h3>Đang Thực Hiện</h3>
                <?php foreach ($tasks as $task) {
                    if ($task['status'] === 'in_progress') {
                        echo "<div class='task' draggable='true' data-id='{$task['id']}'>{$task['title']}</div>";
                    }
                } ?>
            </div>
            <div class="column" id="review">
                <h3>Kiểm Thử</h3>
                <?php foreach ($tasks as $task) {
                    if ($task['status'] === 'review') {
                        echo "<div class='task' draggable='true' data-id='{$task['id']}'>{$task['title']}</div>";
                    }
                } ?>
            </div>
            <div class="column" id="done">
                <h3>Hoàn Thành</h3>
                <?php foreach ($tasks as $task) {
                    if ($task['status'] === 'done') {
                        echo "<div class='task' draggable='true' data-id='{$task['id']}'>{$task['title']}</div>";
                    }
                } ?>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll(".task").forEach(task => {
            task.addEventListener("dragstart", (event) => {
                event.dataTransfer.setData("text", event.target.dataset.id);
                event.target.classList.add("dragging");
            });
            task.addEventListener("dragend", (event) => {
                event.target.classList.remove("dragging");
            });
        });

        document.querySelectorAll(".column").forEach(column => {
            column.addEventListener("dragover", (event) => {
                event.preventDefault();
            });
            column.addEventListener("drop", (event) => {
                event.preventDefault();
                const taskId = event.dataTransfer.getData("text");
                const task = document.querySelector(`.task[data-id='${taskId}']`);
                if (task) {
                    column.appendChild(task);
                }
            });
        });
    </script>
</body>
</html>
