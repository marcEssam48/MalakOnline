<html>
<head>
    <style type="text/css">
        .hover{background-color: #cc0000}
        #container{ margin:0px auto; width: 800px}
        .button {
            font-weight: bold;
            padding: 7px 9px;
            background-color: #5fcf80;
            color: #fff !important;
            font-size: 12px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            cursor: pointer;
            text-decoration: none;
            text-shadow: 0 1px 0px rgba(0,0,0,0.15);
            border-width: 1px 1px 3px !important;
            border-style: solid;
            border-color: #3ac162;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -moz-inline-stack;
            display: inline-block;
            vertical-align: middle;
            zoom: 1;
            border-radius: 3px;
            box-sizing: border-box;
            box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
        }
        .authorBlock{border-top:1px solid #cc0000;}
    </style>
</head>
<body>
<div id="container">
    <h1>Space-O Browser notification demo</h1>

    <h4>Generate Notification with tap on Notification</h4>
    <a href="#" id="notificationlabel" class="button">Notification</a>
</div>
<script type="text/javascript">
    var nid = 29703190101231;
    var x = nid.toString();

    var firstDigit = x[0];
    var year = "";

    if(firstDigit == "2")
    {
        year = "19";
    }
    else if(firstDigit == "3")
    {
        year = "20";
    }
    var birthdateyear = year.concat(x[1]).concat(x[2]);
    var birthdatemonth = x[3].concat(x[4]);
    var birthdateday = x[5].concat(x[6]);

    var birthdate = birthdatemonth.concat("-").concat(birthdateday).concat("-").concat(birthdateyear);
    document.getElementById("notificationlabel").innerHTML = birthdate;


</script>
</body>
</html>