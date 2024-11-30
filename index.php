<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UOB Student Nationality Data</title>
  <link rel="stylesheet" href="https://unpkg.com/picocolors/css/picocolors.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #FAFAFA;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      overflow-x: auto;
      display: block;
    }

    th, td {
      padding: 0.5rem;
      text-align: left;
      border-bottom: 1px solid #DDDDDD;
    }

    th {
      background-color: #4CAF50;
      color: #FFFFFF;
    }

    @media (max-width: 767px) {
      table {
        display: block;
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
      }

      th, td {
        min-width: 150px;
      }
    }
  </style>
</head>
<body>
  <h1>UOB Student Nationality Data</h1>

  <?php
    $apiUrl = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

    try {
      $response = file_get_contents($apiUrl);
      if ($response === false) {
        throw new Exception("Failed to retrieve data from the API.");
      }
      $result = json_decode($response, true);

      if ($result['total_count'] > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Year</th>';
        echo '<th>Semester</th>';
        echo '<th>Programs</th>';
        echo '<th>Nationality</th>';
        echo '<th>Colleges</th>';
        echo '<th>Number of Students</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

       foreach ($result['results'] as $row) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['year']) . '</td>';
          echo '<td>' . htmlspecialchars($row['the_programs']) . '</td>';
          echo '<td>' . htmlspecialchars($row['semester']) . '</td>';
          echo '<td>' . htmlspecialchars($row['nationality']) . '</td>';
          echo '<td>' . htmlspecialchars($row['colleges']) . '</td>';
          echo '<td>' . htmlspecialchars($row['number_of_students']) . '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      } else {
        echo '<p>No data available.</p>';
      }
    } catch (Exception $e) {
      echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
  ?>
</body>
</html>
