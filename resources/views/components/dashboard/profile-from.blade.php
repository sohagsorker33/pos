
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input readonly id="email" placeholder="User Email" class="form-control" type="email"/>
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
                                <label>Mobile Number</label>
                                <input id="phone" placeholder="Mobile" class="form-control" type="phone"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  bg-gradient-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
 getProfile();
    async function getProfile(){
        showLoader();
        let res=await axios.get("/user-profile")
        hideLoader();
        if(res.status===200 && res.data['status']==='success'){
            let data=res.data['data'];
            document.getElementById('email').value=data['email'];
            document.getElementById('firstName').value=data['firstName'];
            document.getElementById('lastName').value=data['lastName'];
            document.getElementById('phone').value=data['phone'];
            document.getElementById('password').value=data['password'];
        }
        else{
            errorToast(res.data['message'])
        }

    }



async function onUpdate(){

let firstName=document.getElementById('firstName').value;

let lastName=document.getElementById('lastName').value;

let phone=document.getElementById('phone').value;

let password=document.getElementById('password').value;

if(firstName.length===0){

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

        let res=await axios.post('/update-profile',{ firstName:firstName, lastName:lastName, phone:phone, password:password});

        hideLoader();

        if(res.status===200 && res.data['status']==='success'){

         successToast("User Update profile Successfully");
        }else{

            errorToast(res.data['message']);

        }

    }catch(error){

        hideLoader();

        errorToast("User Profile Update Failed");

    }

}


}


</script>











