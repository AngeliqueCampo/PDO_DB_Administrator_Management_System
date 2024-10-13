<?php
require_once 'dbConfig.php';
require_once 'models.php';

// insert new DBA record
if (isset($_POST['insertNewDbaBtn'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $dbSpecialization = trim($_POST['dbSpecialization']);
    $certifications = trim($_POST['certifications']);
    $yearsOfExperience = intval(trim($_POST['yearsOfExperience']));
    $contactNumber = trim($_POST['contactNumber']);
    $email = trim($_POST['email']);
    $dateHired = trim($_POST['dateHired']);

    // ensure no fields are empty
    if (!empty($firstName) && !empty($lastName) && !empty($dbSpecialization) && !empty($certifications) &&
        !empty($yearsOfExperience) && !empty($contactNumber) && !empty($email) && !empty($dateHired)) {

        $query = insertIntoDbaRecords($pdo, $firstName, $lastName, $dbSpecialization, $certifications, $yearsOfExperience, $contactNumber, $email, $dateHired);
        
        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Error: Could not insert record.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// update DBA record
if (isset($_POST['editDbaBtn'])) {
    $dbaId = intval($_POST['dba_id']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $dbSpecialization = trim($_POST['dbSpecialization']);
    $certifications = trim($_POST['certifications']);
    $yearsOfExperience = intval(trim($_POST['yearsOfExperience']));
    $contactNumber = trim($_POST['contactNumber']);
    $email = trim($_POST['email']);
    $dateHired = trim($_POST['dateHired']);

    if (!empty($firstName) && !empty($lastName) && !empty($dbSpecialization) && !empty($certifications) &&
        !empty($yearsOfExperience) && !empty($contactNumber) && !empty($email) && !empty($dateHired)) {

        $query = updateDbaRecord($pdo, $dbaId, $firstName, $lastName, $dbSpecialization, $certifications, $yearsOfExperience, $contactNumber, $email, $dateHired);
        
        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Error: Could not update record.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}

// delete DBA record
if (isset($_GET['delete_id'])) {
    $dbaId = intval($_GET['delete_id']);
    $query = deleteDbaRecord($pdo, $dbaId);

    if ($query) {
        header("Location: ../sql/index.php");
        exit;
    } else {
        echo "Error: Could not delete record.";
    }
}
?>
