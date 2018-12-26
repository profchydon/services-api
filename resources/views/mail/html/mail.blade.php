<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
		a.button.button-blue {
			text-align: center;
		}
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">

  <tr>
    <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
        <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
          <tr>
            <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center; background: #13723a;">
              <a style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #fff; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 #ffffff;">
                  Congrats, You have been added as an FRC Admin
              </a>
            </td>
          </tr>

<!-- Email Body -->
<tr>
  <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; border-bottom: 1px solid #edeff2; border-top: 1px solid #edeff2; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
    <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #ffffff; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">

<!-- Body content -->
<tr>

<td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">

    <h3 style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #2F3133; font-size: 16px; font-weight: bold; margin-top: 0; text-align: left;">
    Hi {{ $invitee->name }}
		Please  follow the instructions below.
	</h3>

	<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
		An FRC admin account was created for you by {{ $admin->name }}.

    <br>
    Below are the details of your account:
    <br>
	  <br>
    Name: {{ $invitee->name }}
    <br>
    Email Address: {{ $invitee->email }}
    <br>
    <br>

    You are required to complete this process by clicking on the button or link below <br>

    Please be sure to set your password when redirected by the link below
		<div class="text-center">
			<a href="http://localhost:8000/invite?email={{ $invitee->email }}" class="button button-blue" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #13723a; border-top: 10px solid #13723a; border-right: 18px solid #13723a; border-bottom: 10px solid #13723a; border-left: 18px solid #13723a;">Click here to accept</a>
		<div>
		<br>
		Or click the link below if you are having problems with the button above.
		<a href="" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #3869d4;"> <br>
      http://localhost:8000/invite?email={{ $invitee->email }} </a>,
	</p>

<table class="promotion" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; border: 2px dashed #9BA2AB; margin: 0; margin-bottom: 25px; margin-top: 25px; padding: 24px; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;"><tr>
<td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; line-height: 1.5em; margin-top: 0; font-size: 15px; text-align: center;">We will be glad to have you onboard immediately</p>
        </td>
    </tr></table>
<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787e; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Thanks,<br>

</td>
                                </tr>
</table>
</td>
                    </tr>
<tr>
  <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background: #13723a;">
          <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;"><tr>
  <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px; background: #13723a;">
                      <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em;  margin-top: 0; color: #fff; font-size: 12px; text-align: center;">© 2018 Financialreportingcouncil.com All rights reserved.</p>
                  </td>
              </tr></table>
  </td>
</tr>
</table>
</td>
        </tr></table>
</body>
</html>
