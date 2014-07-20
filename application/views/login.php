<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Comments Engine - Authorized Access Only</title>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <script>
        function checkLogin(form)
        {
		    var username = form.username.value;
		    var password = form.password.value;

		    if (username == '') {}
			    alert("please enter your username.")
			    form.username.focus();

			    return false;
	        }

            if (password == '') {
			    alert("please enter your password.")
			    form.password.focus();

			    return false;
            }
        }
    </script>

    <style>
          body, html {
            font: 12px / 18px Arial;
            background-color: #000000;
            color: #999999;
          }

          .login {
            padding: 0px 10px;
            border: solid 1px #333333;
            background-color: #999999;
            color: #666666;
          }

          td {
              padding: 5px;
          }
    </style>
</head>

<body>
<div style="margin-top:180px;">

  <form name="frmLogin" action="/login/process" method="post" onsubmit="return checkLogin(this);">

  <table align="center" >
<?php if (isset($msg)): ?>
      <tr>
          <td colspan="2"><p align="center" style="font-weight:bold; color:#FF0000;"><?= $msg ?></p></td>
      </tr>
<?php endif; ?>
  	<tr>
    	<td>Username</td>
    	<td><input type="text" name="username" value="<?= isset($username) ? $username : '' ?>"/></td>
    </tr>
    <tr>
    	<td>Password</td>
    	<td><input type="password" name="password" value="<?= isset($password) ? $username : '' ?>" /></td>
    </tr>
    <tr>
    	<td><!--remember?--><input type="hidden" name="remember" value="" /></td>
    	<td><input type="submit" name="submit" class="btn btn-large btn-primary" value="Login"/></td>
    </tr>
  </table>
  </form>

</div>
    <script type="text/javascript">

    var f = document.forms['frmLogin'];

    if (f.username.value.length == 0) {
        f.username.focus();
    } else if (f.password.value.length == 0) {
        f.password.focus();
    }

    </script>
</body>
</html>
