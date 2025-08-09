<?php
require_once 'db_connect.php';

/**
 * Generates a unique Registration Number (RegNo) for a new pet registration.
 * Format: YYYY-1001, where the number increments for each year.
 *
 * @param mysqli $conn The database connection object.
 * @return string The generated registration number.
 * @throws Exception If the ID generation fails.
 */
function generateRegNo($conn) {
    $current_year = date('Y');
    $id_type = 'RegNo';

    $conn->begin_transaction();
    try {
        // Lock the row for update to prevent race conditions
        $sql = "SELECT last_id FROM id_counters WHERE id_type = ? AND year = ? FOR UPDATE";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $id_type, $current_year);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_id = $row['last_id'] + 1;
            $sql_update = "UPDATE id_counters SET last_id = ? WHERE id_type = ? AND year = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("isi", $new_id, $id_type, $current_year);
            $stmt_update->execute();
        } else {
            // First entry for this year
            $new_id = 1001;
            $sql_insert = "INSERT INTO id_counters (id_type, year, last_id) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sii", $id_type, $current_year, $new_id);
            $stmt_insert->execute();
        }

        $conn->commit();
        return $current_year . '-' . $new_id;

    } catch (Exception $e) {
        $conn->rollback();
        throw new Exception("Failed to generate Registration Number: " . $e->getMessage());
    }
}

/**
 * Generates a unique Bill ID (BillId).
 * Format: CPC-1001, where the number increments sequentially.
 *
 * @param mysqli $conn The database connection object.
 * @return string The generated bill ID.
 * @throws Exception If the ID generation fails.
 */
function generateBillId($conn) {
    $id_type = 'BillId';
    $year = 0; // Year is not relevant for BillId

    $conn->begin_transaction();
    try {
        // Lock the row for update
        $sql = "SELECT last_id FROM id_counters WHERE id_type = ? AND year = ? FOR UPDATE";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $id_type, $year);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $new_id = $row['last_id'] + 1;

        $sql_update = "UPDATE id_counters SET last_id = ? WHERE id_type = ? AND year = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("isi", $new_id, $id_type, $year);
        $stmt_update->execute();

        $conn->commit();
        return 'CPC-' . $new_id;

    } catch (Exception $e) {
        $conn->rollback();
        throw new Exception("Failed to generate Bill ID: " . $e->getMessage());
    }
}
?>
