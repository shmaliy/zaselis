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
    <h4>Вы можете войти при помощи Facebook</h4>
    <fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
    <div class="or-intro">Или с помощью e-mail</div>
</div>

<div class="form"><?php echo $this->form; ?></div>


<a class="forgot-pwd" onclick="$('#login-dialog').dialog('close'); $('#restore-dialog').dialog({'modal': true});"><i class="icon icon-info-sign"></i> Забыли пароль?</a>

<script>
$('.ui-dialog #SimpleAuth').submit(function(){
    processUserForm(
        'auth', 
        {'lang': globalLang, 'currencie': globalCurr},
        '#SimpleAuth',
        [['loginSuccess']]
    );
    return false;
});

</script>
