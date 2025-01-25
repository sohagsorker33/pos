<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br/>
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <button onclick="VerifyEmail()"  class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

 async function VerifyEmail(){

    let email=document.getElementById('email').value;

    if(email.length===0){

        errorToast('Email is a required');

    }else{

        try{

            showLoader();

            let res = await axios.post('/send-otp', {email: email});

            hideLoader();

            if(res.status===200 && res.data['status']==='success'){

               successToast('Send OTP Successfully');
               sessionStorage.setItem('email', email);
               setTimeout(() => {

                  window.location.href='/verify-otp-page';

               }, 1000);

            }else{

                errorToast(res.data['message']);

            }

        }catch(error){

            hideLoader();

            errorToast("Send OTP Failed");

        }

    }

 }


</script>
