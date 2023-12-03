<?php

//INSERT
function insert($conn, $table, $data)
{
    // Ensure created_at field is set
    $data['created_at'] = date('Y-m-d H:i:s');

    // Prepare placeholders and values for the query
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_fill(0, count($data), "?"));

    // Construct the query
    $insertQuery = "INSERT INTO $table ($columns) VALUES ($values)";

    // Prepare the statement
    $stmt = $conn->prepare($insertQuery);

    if (!$stmt) {
        echo "Error in preparing statement: " . $conn->error;
        die;
    }

    $types = '';
    $stmt->bind_param($types, ...array_values($data));

    $stmt->execute();

    if ($stmt->error) {
        echo "Error in execution: " . $stmt->error;
        $stmt->close();
        die;
    }

    $stmt->close();

    return true;
}

//GET
function get($conn, $table, $params = null)
{
    $result = array();

    $whereQuery = "WHERE 1 = 1 ";
    if($params != null)
    foreach ($params as $key => $val) {
        $whereQuery .= "AND $key = '" . $conn->real_escape_string($val) . "'";
    }
    $query = "SELECT * FROM $table $whereQuery";
    $getStmt = $conn->query($query);
    if (!$getStmt) {
        echo $query;
        die("Error: " . $conn->error);
    }

    while ($row = $getStmt->fetch_assoc()) {
        $result[] = $row;
    }

    return $result;
}

// UPDATE
function update($conn, $table, $data, $where)
{
    $data['updated_at'] = date('Y-m-d H:i:s');

    $updateQuery = "UPDATE $table SET ";
    $dataQuery = [];
    foreach ($data as $key => $val) {
        $updateQuery .= "$key = ?, ";
        array_push($dataQuery, $val);
    }

    $whereQuery = "WHERE 1 = 1 ";
    foreach ($where as $key => $val) {
        $whereQuery .= "AND $key = ?";
        array_push($dataQuery, $val);
    }

    $updateQuery .= $whereQuery;

    $updateQuery = rtrim($updateQuery, ', ');

    $updateStmt = $conn->prepare($updateQuery);

    if ($updateStmt) {
        $types = str_repeat('s', count($dataQuery));
        $updateStmt->bind_param($types, ...$dataQuery);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        die("Error in preparing statement: " . $conn->error);
    }

    return $updateStmt;
}

// DELETE
function delete($conn, $table, $where = null, $type = NULL)
{
    $type = ($type == null) ? 'AND' : $type;
    $whereQuery = "WHERE 1 = 1 ";
    $params = [];

    if ($where != null) {
        foreach ($where as $key => $val) {
            $whereQuery .= "$type $key = ?";
            $params[] = $val;
        }
    } else {
        $where = [];
    }

    if (count($where) == 0) {
        $deleteQuery = "DELETE FROM $table";
    } else {
        $deleteQuery = "DELETE FROM $table $whereQuery";
    }

    $deleteStmt = $conn->prepare($deleteQuery);

    if ($deleteStmt) {
        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $deleteStmt->bind_param($types, ...$params);
        }

        $deleteStmt->execute();
        $deleteStmt->close();
    } else {
        die("Error in preparing statement: " . $conn->error);
    }

    return $deleteStmt;
}