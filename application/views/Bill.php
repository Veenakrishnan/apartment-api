<!doctype html>
<html lang="en">
<<<<<<< HEAD
<head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Monthly Bill</title>
  </head>
  <body>

    <div class="container" style="margin:15px;">
        <div class="row">
        <?php  
                foreach ($apartment->result() as $row)  
                    { ?>
            <div class="col-md-7 offset-3">
                
                        <h1> <?php echo $row->apartment_name; ?></h1> 
            </div>
        </div><hr>  
        <div class="row">
            <div class="col-md-4"><?php echo $row->adrs;?></div>
            <div class="col-md-4 offset-4"><?php echo $row->name;?><br><?php echo $row->address;?></div>
        </div><hr>
        <div class="row"><div class="col-md-4 offset-4"><?php echo date('M-Y'); ?></div></div><hr>
        <div class="row">
            <div class="col-md-4">Rent</div>
            <div class="col-md-4 offset-4"><?php echo $row->rent;?><br></div>
            <br><br>
        </div>
        <div class="row">
            <div class="offset-4 col-md-4">Total</div>
            <div class="col-md-4"><?php echo $row->rent;?></div>
        </div><hr>
        <div class="row">Paid Date:<?php echo $row->paid_date;?></div>
      <br><br><br>
      <a href="'.base_url().'BillGeneration/pdfdetails/'.$row->paid_date.'">View in PDF</a>
      <a href="'.base_url().'BillGeneration/pdfdetails/102">View in PDF</a>
            <?php   }
         ?> 
        
    </div>
=======
<head> 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Monthly Bill</title>
</head>
<body>
    
<div class="container">
        <div class="row">
            <div class="col-md-7 offset-3">
                <h1>Monthly Bill</h1>
                <hr>
            </div>
        </div>
</div>
>>>>>>> sql
</body>
</html>