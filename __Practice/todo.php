<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "crm";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


/* ================= HANDLE FORM ================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }


    // ADD
    if (isset($_POST['add'])) {

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $status = "pending";

        $stmt = mysqli_prepare($conn,
            "INSERT INTO todo_list (title, description, status, created_at)
             VALUES (?, ?, ?, NOW())"
        );

        mysqli_stmt_bind_param($stmt, "sss", $title, $description, $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // UPDATE
    if (isset($_POST['update'])) {

        $id = intval($_POST['id']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        $stmt = mysqli_prepare($conn,
            "UPDATE todo_list SET title=?, description=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // COMPLETE
    if (isset($_POST['complete'])) {

        $id = intval($_POST['id']);
        $status = "completed";

        $stmt = mysqli_prepare($conn,
            "UPDATE todo_list SET status=? WHERE id=?"
        );

        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

/* ================= FETCH DATA ================= */

$result = mysqli_query($conn, "SELECT * FROM todo_list ORDER BY id asc ");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto p-4">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Todo List</h1>
        <button onclick="openModal()"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Add Task
        </button>
    </div>

    <div class="space-y-4">

        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">

                <div>
                    <h2 class="font-semibold text-lg">
                        <?= htmlspecialchars($row['title']) ?>
                    </h2>

                    <p class="text-gray-600 text-sm">
                        <?= htmlspecialchars($row['description']) ?>
                    </p>

                    <?php if($row['status'] == "pending"): ?>
                        <span class="text-xs text-yellow-600 font-medium">Pending</span>
                    <?php else: ?>
                        <span class="text-xs text-green-600 font-medium">Completed</span>
                    <?php endif; ?>
                </div>

                <div class="flex gap-2">

                    <button
                        onclick="editTask(
                            '<?= $row['id'] ?>',
                            '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
                            '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>'
                            )"
                        class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">
                        Edit
                    </button>

                    <?php if($row['status'] == "pending"): ?>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="complete"
                                    class="bg-green-600 text-white px-3 py-1 rounded-md text-sm">
                                Complete
                            </button>
                        </form>
                    <?php endif; ?>

                </div>
            </div>
        <?php endwhile; ?>

    </div>
</div>

<!-- MODAL -->
<div id="taskModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">

    <div class="bg-white w-11/12 md:w-1/3 rounded-xl p-6">

        <h2 id="modalTitle" class="text-xl font-bold mb-4">Add Task</h2>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="id" id="taskId">

            <div class="mb-3">
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" id="taskTitle"
                       class="w-full border rounded-lg px-3 py-2 mt-1"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" id="taskDescription"
                          class="w-full border rounded-lg px-3 py-2 mt-1"
                          required></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg">
                    Cancel
                </button>

                <button type="submit" name="add" id="submitBtn"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("taskModal").classList.remove("hidden");
        document.getElementById("modalTitle").innerText = "Add Task";
        document.getElementById("submitBtn").name = "add";

        document.getElementById("taskId").value = "";
        document.getElementById("taskTitle").value = "";
        document.getElementById("taskDescription").value = "";
    }

    function closeModal() {
        document.getElementById("taskModal").classList.add("hidden");
    }

    function editTask(id, title, description) {
        document.getElementById("taskModal").classList.remove("hidden");
        document.getElementById("modalTitle").innerText = "Update Task";

        document.getElementById("taskId").value = id;
        document.getElementById("taskTitle").value = title;
        document.getElementById("taskDescription").value = description;

        document.getElementById("submitBtn").name = "update";
    }
</script>

</body>
</html>

<?php mysqli_close($conn); ?>
