<?php
/**
* Template Name: Login
*/
    if($_POST['pwd']!=''){
    $response = wp_signon( $credentials );
        if( !is_wp_error( $response ) ) {
            header("Location: /my-story");
        }   
    }
    get_header();
?>

<form id="login" method="post"<?php if (get_the_ID() == 21) echo' class="active"'; ?>>
    <span class="login active">Login</span>
    <span class="signup">Sign Up</span>
<?php
    if( is_wp_error( $response ) ) {
        echo '<p class="error">Email address and/or Password is invalid.</p>';
    }   
?>
    
    <input type="email" name="log" placeholder="Email...">
    <input type="password" name="pwd" placeholder="Password...">
    <input type="hidden" name="rememberme" value="forever">
    <input type="submit" value="login" class="button">
    <span class="lostpassword">Lost Password?</span>
</form>
<form id="signup" method="post"<?php if (get_the_ID() == 23) echo' class="active"'; ?>>
    <span class="login">Login</span>
    <span class="signup active">Sign Up</span>
    <input type="email" name="email" placeholder="Email...">
    <input type="submit" value="Sign Up" class="button">
    <p>You will receive an email containing your password.<br>If you do not see the email please check your junk folder.</p>
</form>
<form id="lostpassword" method="post">
    <span class="login active">Login</span>
    <span class="signup">Sign Up</span>
    <input type="email" name="email" placeholder="Email...">
    <input type="submit" value="Get New Password" class="button">
</form>

<?php

    
    get_footer();
 ?> 
