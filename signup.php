<?php
    include './inc/header.php';
?><br>
<?php
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        $insertuser =$usr->insertuser($_POST,$_FILES);
    }
?>	
    <div class="container signupform">
        <h3>Register New Account</h3><br>
        <span style="text-align: center"><?php
        if (isset($insertuser )) {
            echo $insertuser ;
        }
        ?></span>
        <form action="" enctype="multipart/form-data" method="POST" >
        
            <table class="signuptable">
                <tr>
                    <td>
                        <input type="text" name="name" maxlength="8" required placeholder="Nickname">
                    </td>
                    <td>
                        <input type="text" name="address" required placeholder="Address">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="city" required placeholder="City">
                    </td>
                    <td>
                        <input type="text"  name="country" required placeholder="Country">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" required placeholder="Email Address">
                    </td>
                    <td>
                        <input type="password" name="pass" required placeholder="Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 style="margin-left:5px"> Choose A Profile Picture (Optional) : </h5>
                    </td>
                    <td class="tableimg" colspan="2">
                        <img id="ImdID"   src="./images/1.png" alt="Image" width="70px" height="65px" style="border-radius:45px" />
                        <input type='file' name="avatar" onchange="readURL(this);" value="./images/1.png"  />
                    </td> 
                </tr>
                <tr>
                    <td >
                        <input type="submit" value="Submit" >
                    </td>
                    <td>
                        <span>Already Have An Account ? </span><a onclick="document.getElementById('modal-wrapper').style.display='block'; document.querySelector('.content').style.opacity='.5'" style="color: blue; cursor:pointer;" > Click Here !</a>
                    </td>
                </tr>
                
            </table>
        </form>
    </div>

<?php
    include './inc/footer.php';
?>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
    $('#ImdID').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
    }
}</script>