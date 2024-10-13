<?php
require_once 'dbConfig.php';

// insert new DBA record
function insertIntoDbaRecords($pdo, $first_name, $last_name, $db_specialization, $certifications, $years_of_experience, $contact_number, $email, $date_hired) {
    $sql = "INSERT INTO database_administrator (first_name, last_name, db_specialization, certifications, years_of_experience, contact_number, email, date_hired)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $db_specialization, $certifications, $years_of_experience, $contact_number, $email, $date_hired]);
}

// retrieve all DBA records
function seeAllDbaRecords($pdo) {
    $sql = "SELECT * FROM database_administrator";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// update DBA record
function updateDbaRecord($pdo, $dba_id, $first_name, $last_name, $db_specialization, $certifications, $years_of_experience, $contact_number, $email, $date_hired) {
    $sql = "UPDATE database_administrator
            SET first_name = ?, last_name = ?, db_specialization = ?, certifications = ?, years_of_experience = ?, contact_number = ?, email = ?, date_hired = ?
            WHERE dba_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $db_specialization, $certifications, $years_of_experience, $contact_number, $email, $date_hired, $dba_id]);
}

// delete DBA record
function deleteDbaRecord($pdo, $dba_id) {
    $sql = "DELETE FROM database_administrator WHERE dba_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$dba_id]);
}

// retrieve a single DBA record by ID for editing
function seeDbaRecordById($pdo, $dba_id) {
    $sql = "SELECT * FROM database_administrator WHERE dba_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$dba_id]);
    return $stmt->fetch();
}

?>
