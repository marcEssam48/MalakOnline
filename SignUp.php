<!DOCTYPE html>
<html lang="en">
<head>
    <title>Malak Online</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="Admin/assets/img/malak.jpeg"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
        <div class="wrap-login100">
            <form name="myForm" method="post"  onsubmit="return validateForm();" action="Controller/SignUpController.php" >
					<span class="login100-form-logo">
<!--						<i class="zmdi zmdi-landscape"></i>-->

                        <img src="Admin/assets/img/church.jpg" width="100%"style="border-radius:50%">

					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						إنشاء حساب
					</span>

                <div class="wrap-input100 validate-input" >
                    <input class="input100" type="text" name="username"  placeholder="اسم المستخدم ثلاثي بالعربية">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" name="pass" placeholder="كلمة المرور">

                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" >
                    <input class="input100" type="password" name="Confpass" placeholder="تأكيد كلمة المرور">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" >
                    <input class="input100" type="number" name="mobile" placeholder="رقم الموبايل" >
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <!--                data-validate="Enter Date Of Birth"-->
                <div class="wrap-input100 validate-input" >


                    <input class="input100" type="Date" name="DOB" placeholder="تاريخ الميلاد" >
                    تاريخ الميلاد
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" >


                    <input class="input100" type="number" name="nid" placeholder="  الرقم القومي" >

                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input" >


                    <select class="form-control" name="gender">
                        <option value="3"> شماس</option>
                        <option value="1"> رجال</option>
                        <option value="2"> سيدات</option>


                    </select>


                </div>
                <div class="row">
                    <div class="col-6" >


                        <input class="form-control" type="text" name="street_no" placeholder="  رقم العمارة " >

                        <!--<span class="focus-input100" data-placeholder="&#xf191;"></span>-->
                    </div>
                    <div class="col-6" >


                        <input class="form-control" type="text" name="street_name" placeholder="  أسم الشارع " >

                        <!--<span class="focus-input100" data-placeholder="&#xf191;"></span>-->
                    </div>

                    <div class="col-6" >


                        <input class="form-control" type="text" name="level_no" placeholder=" الدور " >

                        <!--<span class="focus-input100" data-placeholder="&#xf191;"></span>-->
                    </div>

                    <div class="col-6" >


                        <input class="form-control" type="text" name="flat_no" placeholder=" رقم الشقة " >

                        <!--<span class="focus-input100" data-placeholder="&#xf191;"></span>-->
                    </div>


                </div>
                <br>
                <hr>
                <div style="text-align: right;">
                    <span style="color: darkred">*</span>  <span style="text-align: right;color:white;">هذا الجزء هام في حالة ان نسيت كلمة المرور</span> <span style="color: darkred">*</span>
                </div>
                <br>
                <div class="form-group" style="text-align: right">
                    <label style="color: white">أدخل السؤال الذي تريده ان يكون السؤال الأمني في حالة نسيان كلمة المرور </label>
                    <input type="text" name="secqu" class="form-control" placeholder="السؤال">

                    <label style="color: white">أدخل إجابة السؤال </label>
                    <input type="text" name="ansqu" class="form-control" placeholder="الإجابة">
                </div>

<br>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" name="signup">
                        Sign Up
                    </button>
                </div>
                <br>

                <div class="container-login100-form-btn">
                    <h6>لديك حساب ؟ <a href="index.php"><span style="color:white">

                   تسجيل الدخول
                     </span>
                        </a>
                    </h6>
                </div>


            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script>

    function validateForm() {
        var pass = document.forms["myForm"]["pass"].value;
        var confpass =  document.forms["myForm"]["Confpass"].value;
        var mobile =  document.forms["myForm"]["mobile"].value;
        var nid =  document.forms["myForm"]["nid"].value;
        var DOB = document.forms["myForm"]["DOB"].value;
        var secqu = document.forms["myForm"]["secqu"].value;
        var ansqu = document.forms["myForm"]["ansqu"].value;
        var username = document.forms["myForm"]["username"].value;
        var category = document.forms["myForm"]["gender"].value;

        var cat = category.toString();

        var governorates = ["01", "02", "03","04","11","12","13","14","15","16","17","18","19","21","22","23","24","25","26","27","28","29","31","32","33","34","35","88"];





        if(nid.length == 14) {
            if (DOB !== "")
            {

                var x = nid.toString();

                var gender = x[12];

                var genderint = parseInt(gender);
                var gov_nid = x[7].concat(x[8]);

                var index = governorates.indexOf(gov_nid);

                if(index == -1)
                {
                    alert("الرقم القومي غير صحيح");
                    return false;

                }

                if(genderint %2 == 0)
                {
                    if(cat !== "2")
                    {
                        alert("الرقم القومي غير صحيح");
                        return false;

                    }

                }
                else if(genderint %2 !== 0 )
                {
                    if(cat !== "3" && cat !== "1")
                    {
                        alert("الرقم القومي غير صحيح");
                        return false;
                    }

                }

            var firstDigit = x[0];
            var year = "";

            if (firstDigit == "2") {
                year = "19";
            }
            else if (firstDigit == "3") {
                year = "20";
            }
            var birthdateyear = year.concat(x[1]).concat(x[2]);
            var birthdatemonth = x[3].concat(x[4]);

            var birthdateday = x[5].concat(x[6]);

            var birthdate = birthdateyear.concat("-").concat(birthdatemonth).concat("-").concat(birthdateday);


            var birthdateparsed = Date.parse(birthdate);
            var DOBparsed = Date.parse(DOB);

            if (birthdateparsed !== DOBparsed) {
                alert("الرقم القومي غير صحيح");
                return false;
            }
        }
        else
            {
                alert("برجاء إدخال  تاريخ الميلاد");
                return false;
            }
        }
        else if (nid.length == 0)
        {
            alert("برجاء إدخال الرقم القومي");
            return false;

        }
        else
        {
            alert("الرقم القومي غير صحيح");
            return false;
        }





         if(secqu == "" || ansqu == "")
         {
             alert("يجب عليك إدخال سؤال الأمان و إجابته");
             return false;
         }

         if(username == "")
         {
             {
                 alert("من فضلك أدخل اسم المستخدم");
                 return false;
             }
         }

        if (pass.length < 8) {
            alert("يجب ان تكون كلمة المرور مكونة من 8 أحرف أو أرقام او مزيج منهما علي الأقل");
            return false;
        }
        if(pass !== confpass)
        {
            alert("كلمات السر لا تساوي بعضها");
            return false;
        }
        if(mobile.length !== 11){
            alert("رقم المحمول غير صحيح");
            return false;
        }
        if(nid.length !== 14){
            alert("الرقم القومي غير صحيح ");
            return false;
        }
    }
</script>
<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>


<script type="text/javascript">
    function restrictInputOtherThanArabic($field)
    {
        // Arabic characters fall in the Unicode range 0600 - 06FF
        var arabicCharUnicodeRange = /[\u0600-\u06FF]/;

        $field.bind("keypress", function(event)
        {
            var key = event.which;
            // 0 = numpad
            // 8 = backspace
            // 32 = space
            if (key==8 || key==0 || key === 32)
            {
                return true;
            }

            var str = String.fromCharCode(key);
            if ( arabicCharUnicodeRange.test(str) )
            {
                return true;
            }

            return false;
        });
    }

    jQuery(document).ready(function() {
        // allow arabic characters only for following fields
        restrictInputOtherThanArabic($('#username_arabic'));

    });
</script>
</body>
</html>