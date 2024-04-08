<?php
require_once('../admin/src/functions.php');
$core= new atwLive();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>V Africa- Revcon Tickets </title>
<!-- Include Bootstrap CSS for styling -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<!-- Include Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
</head>
<body>

<div class="container">
    <h2>Tickets details</h2>
    <table id="data-table" class="table table-bordered">
        <thead>
            <tr>
                <th>S/No.</th>
                
                <th>Passcode</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $core->payment_export(); 

        ?>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!-- Include Buttons JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<!-- Include JSZip library for Excel export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- Include DataTables Buttons extension -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<!-- Include DataTables Buttons extension (PDF button specifically) -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#data-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Export CSV'
            },
            {
                extend: 'excel',
                text: 'Export Excel'
            },
            {
                extend: 'pdf',
                text: 'Export PDF',
                customize: function (doc) {
                    // Add styles to the PDF output
                    doc.styles.tableHeader = {
                        fillColor: '#f3f3f3',
                        fontSize: 10,
                        bold: true,
                        color: 'black'
                    };
                    // Increase column width for all columns
                    doc.content[1].table.widths = ['40%', '40%']; // Adjust percentages as needed
                }
            }
        ]
    });
});
</script>

</body>
</html>
