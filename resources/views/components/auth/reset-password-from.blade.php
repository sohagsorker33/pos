<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90 p-4">
                <div class="card-body">
                    <h4>SET NEW PASSWORD</h4>
                    <br/>
                    <label>New Password</label>
                    <input id="password" placeholder="New Password" class="form-control" type="password"/>
                    <br/>
                    <label>Confirm Password</label>
                    <input id="cpassword" placeholder="Confirm Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="ResetPass()" class="btn w-100 bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

 async function ResetPass(){
    let password=document.getElementById('password').value;
    let cpassword=document.getElementById('cpassword').value;

    if(password.length===0){
        errorToast('Password required')
    }else if(cpassword.length===0){
        errorToast('Confram Password required')
    }else if( password !==cpassword){
        errorToast('Does not match Password')
    }else{
        try{
            showLoader();
            let res=await axios.post('/reset-password',{password:password, cpassword:cpassword});
            hideLoader();
            if(res.status===200 && res.data['status']==='success'){
               successToast(res.data['message']);
               setTimeout(() => {
                  window.location.href='/login-page'
               }, 1000);
            }else{}
        }catch(error){
            hideLoader();
            errorToast('Password Reset Failed');

        }
    }

 }


</script>
