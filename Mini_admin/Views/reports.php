<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>

<table class="table table-bordered" id="tabledata">
    <tr>
        <th>S/N</th>
        <th>Firstname</th>
        <th>Lastname</th>
    </tr>

    <tr>
        <td>1</td>
        <td>Saheed</td>
        <td>Babatunde</td>
    </tr>

    <tr>
        <td>2</td>
        <td>Saheed</td>
        <td>Babatunde</td>
    </tr>

    <tr>
        <td>3</td>
        <td>Saheed</td>
        <td>Babatunde</td>
    </tr>

    <tr>
        <td>4</td>
        <td>Saheed</td>
        <td>Babatunde</td>
    </tr>

</table>

<center>
    <button class="btn btn-success" onclick="downloadDoc()">Download PDF</button>
</center>

<script type="text/javascript" src="../assets/js/jquery.js"></script>

<script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>

<script type="text/javascript" src="../assets/js/html2canvas.min.js"></script>

<script type="text/javascript">
    function downloadDoc(){

        html2canvas($("#tabledata")[0],{
            onrendered:function(canvas){
                var data=canvas.toDataURL();
                var docDefinition={
                    content:[{
                        image:data,
                        width:500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Table.pdf");
            }
        })



    }


</script>
</body>
</html>