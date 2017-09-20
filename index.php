<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">


    <script type="text/javascript">
        $(document).ready(function(){
            //==============Registr and Auto=========
              //===ajax
              $('#createT').click(function(){
                $('#div_sku_table').html('');
                  $.ajax({
                      url: "auth.php",
                      type: "POST",
                      data:{},
                      success: function(data){
                        tableCreate(data);
                        alert("Вы успешно выполнили запрос!");
                    } 
                  });
              });
          function tableCreate(jsonD){

            var data = JSON.parse(jsonD);
              console.log(data);
            $('#div_sku_table').append('<table class="table" id="table_sku"></table>');
            for (var i = 0; i <= data.length-1; i++) {
              $('#table_sku').append('<tr><td>'+data[i]["art"]+'</td>'+
                '<td>'+data[i]["name"]+'</td>'+
                '<td>'+data[i]["part"]+'</td>'+
                '<td>'+data[i]["ostatok"]+'</td>'+
                '<td>'+data[i]["price"]+'</td>'+
                '</tr>')
              
            };
          }
        });
            //======END!!
    </script>
</head>
<body>
  <button type="submit" class="btn btn-default" id="createT">Create Table</button>
  <div class="row">
  <div class="col-md-12" id="div_sku_table"></div>
</div>
</body>
</html>