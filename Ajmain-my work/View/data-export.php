<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Export</title>
  <link rel="stylesheet" href="../Assets/export.css" />
</head>
<body>
  <div class="container">
    <h1>Data Export</h1>
    
    <form id="exportForm">
      <div class="form-group">
        <label for="dataRange">Select data range:</label>
        <select id="dataRange" required>
          <option value="">--Select--</option>
          <option value="summary">Summary Only</option>
          <option value="full">Full Report</option>
          <option value="custom">Custom Data</option>
        </select>
      </div>

      <div class="form-group">
        <label for="format">Choose format:</label>
        <select id="format" required>
          <option value="">--Select--</option>
          <option value="pdf">PDF</option>
          <option value="csv">CSV</option>
        </select>
      </div>

      <div class="form-group">
        <label><input type="checkbox" id="scheduleExport"> Schedule export</label>
      </div>

      <div class="form-group" id="scheduleOptions" style="display: none;">
        <label for="scheduleDate">Export date:</label>
        <input type="datetime-local" id="scheduleDate">
      </div>

      <button type="submit">Download</button>
    </form>

    <p id="statusMessage"></p>
  </div>

  <script src="../Assets/export.js"></script>
</body>
</html>
