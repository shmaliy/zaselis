<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?php echo $this->client_id; ?>',
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true,  // parse XFBML
            scope      : '<?php echo $this->scope; ?>'
        });

        FB.Event.subscribe('auth.authResponseChange', function(response) {
            if (response.status === 'connected') {
                window.location = 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/<?php echo $this->lang['alias']; ?>/<?php echo strtolower($this->current['alias']); ?>/fbauth/'
            }
        });
    };

    // Load the SDK asynchronously
    (function(d){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked. -->

<div class="auth-by-fb">
    <h4>Вы можете зарегистрироваться при помощи Facebook</h4>
    <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
    <div class="or-intro">Или зарегистрироваться с помощью e-mail</div>
</div>

<div class="form"><?php echo $this->form; ?></div>

<script>

$('#SimpleRegister #password_p-element').hide();
$('#SimpleRegister #password').focus(function(){
    $('#SimpleRegister #password_p-element').show();
});

$('.ui-dialog #SimpleRegister').submit(function(){
    processUserForm(
        'simple-register', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#SimpleRegister',
        [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
    );
    return false;
});
</script>