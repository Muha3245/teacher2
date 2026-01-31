<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Set Your Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f9fc; padding: 30px;">
    <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 30px;">
                <h2 style="color: #2f2f2f;">Hi {{ $user->name }},</h2>

                <p style="font-size: 15px; color: #555;">
                    You’ve been added to our system. Please click the button below to set your password and activate your account:
                </p>

                <p style="text-align: center; margin: 40px 0;">
                    <a href="{{ $verificationLink  }}" style="background-color: #4CAF50; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; display: inline-block;">
                        Verify Account
                    </a>
                </p>

                <p style="font-size: 14px; color: #888;">
                    This link is valid only once. If you didn’t expect this, you can safely ignore it.
                </p>

                <p style="font-size: 13px; color: #ccc; margin-top: 30px;">
                    &mdash; CLTGroup Dispatch Portal
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
