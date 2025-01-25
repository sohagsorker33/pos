<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>phone Number</label>
                                <input id="phone" placeholder="Mobile" class="form-control" type="phone"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

   async function onRegistration(){

    let email=document.getElementById('email').value;

    let firstName=document.getElementById('firstName').value;

    let lastName=document.getElementById('lastName').value;

    let phone=document.getElementById('phone').value;

    let password=document.getElementById('password').value;

    if(email.length===0 && firstName.length===0 && lastName.length===0 && phone.length ===0 && password.length===0 ){

        errorToast('All fields are required')

    }else if(email.length===0 && firstName.length===0){

        errorToast('Email or FirstName Required')

    }else if(email.length===0 && lastName.length===0){

      errorToast("Email or LastName Required")

    }else if (email.length===0 && phone.length===0){

        errorToast("Email or Phone Required")

    }else if(email.length===0 && password.length===0){

        errorToast("Email or Password Required")

    }else if(firstName.length===0 && lastName.length===0){

        errorToast("FirstName or LastName Required")

    }else if(firstName.length===0 && phone.length===0){

        errorToast("FirstName or Phone Required");


    }else if(firstName.length===0 && password.length===0){

        errorToast("FirstName or Password Required")

    }else if(lastName.length===0 && phone.length===0){

        errorToast("LastName or Phone Required");

    }else if(lastName.length===0 && password.length===0){

        errorToast("LastName or Password Required");

    }else if(phone.length===0 && password===0){

        errorToast("Phone or Password Required");

    }else if(email.length===0){

        errorToast("Email is a Required");

    }else if(firstName.length===0){

        errorToast("FirstName is a Required");

    }else if(lastName.length===0){

        errorToast("LastName is a Required");

    }else if(phone.length===0){

        errorToast("Phone is a Required");

    }else if(password.length===0){

        errorToast(" Password is a Required");

    }else{

        try{

            showLoader();

            let res=await axios.post('/user-register',{email:email, firstName:firstName, lastName:lastName, phone:phone, password:password});

            hideLoader();

            if(res.status===200 && res.data['status']==='success'){

             successToast("User Registration Successfully");

             setTimeout(() => {
               window.location.href='/login-page';
             },1000);

            }else{

                errorToast(res.data['message']);

            }

        }catch(error){

            hideLoader();

            errorToast("User Registration Failed");

        }

    }


   }

</script>
