// <!-- data validation  -->



        function validatePhoneNumber(number) {
            var phonePattern = /^[0-9]*\d{11}/;
            return phonePattern.test(number);
        }
        function validatePhoneEmail(email){
            var emailPattern =/^[a-zA-Z0-9]*[@][a-zA-Z]*[\.][a-z]/;
           return emailPattern.test(email);
        }
        function validatePhoneName(name){
            var namePattern =/^[a-zA-Z ]/

           return namePattern.test(name);
        }
        function validatePhoneImage(image){
            var imagePattern = /^.*\.(jpg|jpeg|png)$/i

           return imagePattern.test(image);
        }
      


        function validateForm() {
            console.log("rayhan");
            var name = document.getElementById("v_name").value;
            var number = document.getElementById("v_number").value;
            var email = document.getElementById("v_email").value;
            var address = document.getElementById("v_address").value;
            var image = document.getElementById("v_image").value;
            var date = document.getElementById("v_date").value;
            var gender = document.getElementById("v_gender" + formCount + "_male");
           var gender = document.getElementById("v_gender" + formCount + "_female");



            var password = document.getElementById("v_password").value;


            if (name == "") {
                document.getElementById('err_name').innerHTML = "Please enter your name!";
            }else if (!validatePhoneName(name)){
                document.getElementById('err_name').innerHTML = "Please enter a valid Name!";
            }
             else if (!validatePhoneNumber(number)) {
                document.getElementById('err_number').innerHTML = "Please enter a valid phone number!";
            }
            else if (email == "") {
                document.getElementById('err_email').innerHTML = "Please enter your email address!";
            } else if (!validatePhoneEmail(email)){
                document.getElementById('err_email').innerHTML = "Please enter a valid Email!";
            } else if(address == "") {
                document.getElementById('err_address').innerHTML = "Please enter your address!";
            }else if(image == "") {
                document.getElementById('err_image').innerHTML = "Please enter your Image!";
            } else if (!validatePhoneImage(image)){
                document.getElementById('err_image').innerHTML = "Please enter a valid image";
            }
            else if(date == "") {
                document.getElementById('err_date').innerHTML = "Please enter Date!";
            }else if(gender == "") {
                document.getElementById('err_gender').innerHTML = "Please enter your Gender!";
            }

            else if (password == "") {
                document.getElementById('err_password').innerHTML = "Please enter your password!";
            } else if (password.length < 8) {
                document.getElementById('err_password').innerHTML = "Password must be at least 8 characters long!";
            }else {
                return true;
           }

           return false;
   
        }

   

