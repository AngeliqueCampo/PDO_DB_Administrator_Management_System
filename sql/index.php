<?php
require_once '../core/models.php';
require_once '../core/dbConfig.php';

// initialize variables
$firstName = $lastName = $dbSpecialization = $certifications = $contactNumber = $email = $dateHired = '';
$yearsOfExperience = 0;
$editMode = false;
$editId = 0;

// check if editing an existing record
if (isset($_GET['edit_id'])) {
    $editId = intval($_GET['edit_id']);
    $recordToEdit = seeDbaRecordById($pdo, $editId); // Fetch record by ID

    if ($recordToEdit) {
        // use fields with existing data
        $firstName = htmlspecialchars($recordToEdit['first_name']);
        $lastName = htmlspecialchars($recordToEdit['last_name']);
        $dbSpecialization = htmlspecialchars($recordToEdit['db_specialization']);
        $certifications = htmlspecialchars($recordToEdit['certifications']);
        $yearsOfExperience = intval($recordToEdit['years_of_experience']);
        $contactNumber = htmlspecialchars($recordToEdit['contact_number']);
        $email = htmlspecialchars($recordToEdit['email']);
        $dateHired = htmlspecialchars($recordToEdit['date_hired']);
        $editMode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Administrator Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        input {
            font-size: 1.2em;
            padding: 10px;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h3>Database Administrator Management System</h3>
    
    <!-- form for adding/updating a record -->
    <form action="../core/handleForm.php" method="POST">
        <p>
            <label>First Name: </label>
            <input type="text" name="firstName" value="<?= $firstName ?>" required>
        </p>
        <p>
            <label>Last Name: </label>
            <input type="text" name="lastName" value="<?= $lastName ?>" required>
        </p>
        <p>
            <label>Database Specialization: </label>
            <input type="text" name="dbSpecialization" value="<?= $dbSpecialization ?>" required>
        </p>
        <p>
            <label>Certifications: </label>
            <input type="text" name="certifications" value="<?= $certifications ?>" required>
        </p>
        <p>
            <label>Years of Experience: </label>
            <input type="number" name="yearsOfExperience" value="<?= $yearsOfExperience ?>" min="0" required>
        </p>
        <p>
            <label>Contact Number: </label>
            <input type="text" name="contactNumber" value="<?= $contactNumber ?>" required>
        </p>
        <p>
            <label>Email: </label>
            <input type="email" name="email" value="<?= $email ?>" required>
        </p>
        <p>
            <label>Date Hired: </label>
            <input type="date" name="dateHired" value="<?= $dateHired ?>" required>
        </p>

        <!-- hidden fields for edit mode -->
        <?php if ($editMode): ?>
            <input type="hidden" name="dba_id" value="<?= $editId ?>">
            <input type="submit" name="editDbaBtn" value="Update">
        <?php else: ?>
            <input type="submit" name="insertNewDbaBtn" value="Submit">
        <?php endif; ?>
    </form>

    <h3>All Database Administrators</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Specialization</th>
            <th>Certifications</th>
            <th>Experience</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Date Hired</th>
            <th>Actions</th>
        </tr>
        <?php
        // fetch all DBA records and display in table
        $records = seeAllDbaRecords($pdo);
        foreach ($records as $row):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['dba_id']); ?></td>
            <td><?= htmlspecialchars($row['first_name']); ?></td>
            <td><?= htmlspecialchars($row['last_name']); ?></td>
            <td><?= htmlspecialchars($row['db_specialization']); ?></td>
            <td><?= htmlspecialchars($row['certifications']); ?></td>
            <td><?= htmlspecialchars($row['years_of_experience']); ?></td>
            <td><?= htmlspecialchars($row['contact_number']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['date_hired']); ?></td>
            <td>
                <a href="index.php?edit_id=<?= htmlspecialchars($row['dba_id']); ?>">Edit</a> |
                <a href="../core/handleForm.php?delete_id=<?= htmlspecialchars($row['dba_id']); ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
