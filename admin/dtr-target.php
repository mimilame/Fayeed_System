<?php include 'head.php';?>

<title>sdasdasd</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.0/css/buttons.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.0/js/buttons.html5.min.js"></script>
        <body style="background: #929292;">
            
        
            <br><br><br><div class="container bg-dark" >
               
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Morning In</th>
                        <th>Morning Out</th>
                        <th>Afternoon In</th>
                        <th>Afternoon Out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($dtr_att = mysqli_fetch_array($dtttrr)){?> 
                        <tr>
                            <td><?php echo $dtr_att['dtrdate']?></td>
                            <td><?php echo $dtr_att['morning_in']?></td>
                            <td><?php echo $dtr_att['morning_out']?></td>
                            <td><?php echo $dtr_att['afternoon_in']?></td>
                            <td><?php echo $dtr_att['afternoon_out']?></td>
                        </tr>
                    <?php }?>
                </tbody>
                
            </table>
            </div>
        </div>
        </body>
        <!--**********************************
            Content body end
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ***********************************-->
        
    </div>
    </body>
    <script>
   $(document).ready(function() {
  $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      {
        extend: 'excelHtml5',
        title: '<?php echo $titlesssss ?>'
      },
      {
        extend: 'pdfHtml5',
        orientation: 'portrait',
        pageSize: 'Legal',
        title: '<?php echo $titlesssss ?>',
        customize: function(doc) {
          // Adjust table layout to occupy full width in PDF
          doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      },
      {
        text: 'Back',
        action: function() {
          window.location.href = 'dtr.php'; // Replace with your desired URL
        }
      }
    ]
  });
});

</script>
