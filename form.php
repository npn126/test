<?php

$students = array(); // Khởi tạo mảng danh sách sinh viên

// Mở file CSV để đọc dữ liệu
if (($handle = fopen("student.csv", "r")) !== FALSE) {
    // Đọc từng dòng dữ liệu từ file
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Thêm thông tin sinh viên vào mảng
        $student = array(
            'id' => $data[0],
            'name' => $data[1],
            'age' => $data[2],
            'grade' => $data[3]
        );
        array_push($students, $student);
    }
    fclose($handle); // Đóng file
}

// Hiển thị danh sách sinh viên lên trang web
foreach ($students as $student) {
    echo "<p>ID: " . $student['id'] . "</p>";
    echo "<p>Name: " . $student['name'] . "</p>";
    echo "<p>Age: " . $student['age'] . "</p>";
    echo "<p>Grade: " . $student['grade'] . "</p>";
}

?>



<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <h1 class="mb-2">Add student</h1>
            <form action="" method="post">
                <?php if (!empty($err)) {
                            echo $err;
                        } ?>
                <div class="form-group mb-2">
                    <label>ID:</label>
                    <input type="text" class="form-control" placeholder="ID" name="userid" required>
                </div>
                <div class="form-group mb-2">
                    <label>Name:</label>
                    <input type="text" class="form-control" placeholder="Name" name="username" required>
                </div>
                <div class="form-group mb-2">
                    <label>Age:</label>
                    <input type="text" class="form-control" placeholder="Age" name="age" required>
                </div>
                <div class="form-group mb-2">
                    <label>Grade:</label>
                    <input type="text" class="form-control" placeholder="Grade" name="grade" required>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>



<?php

if (isset($_POST['submit'])) {
    // Lấy thông tin sinh viên từ form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    // Mở file CSV để ghi dữ liệu
    $handle = fopen("student.csv", "a");
    // Ghi thông tin sinh viên vào file CSV
    $line = array($id, $name, $age, $grade);
    fputcsv($handle, $line);
    fclose($handle); // Đóng file

    // Chuyển hướng về trang hiển thị danh sách sinh viên
    header('Location: form.php');
    exit;
}

?>
