<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <title>Password Reset</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif; color:#333333;">

```
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; background-color:#f4f6f8; margin:0; padding:0;">
    <tr>
        <td align="center" style="padding:40px 15px;">

            <!-- Main Container -->
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width:100%; max-width:600px; background-color:#ffffff; border-radius:8px; overflow:hidden;">

                <!-- Header -->
                <tr>
                    <td align="center" style="padding:30px 30px 20px 30px; background-color:#ffffff;">
                        <h1 style="margin:0; font-size:26px; line-height:36px; color:#222222; font-weight:600;">
                            {{APP_NAME}}
                        </h1>
                    </td>
                </tr>

                <!-- Content -->
                <tr>
                    <td style="padding:10px 40px 40px 40px;">

                        <h2 style="margin:0 0 20px 0; font-size:24px; line-height:32px; color:#222222; font-weight:600;">
                            Reset Your Password
                        </h2>

                        <p style="margin:0 0 15px 0; font-size:16px; line-height:26px; color:#555555;">
                            Hello {{USER_NAME}},
                        </p>

                        <p style="margin:0 0 20px 0; font-size:16px; line-height:26px; color:#555555;">
                            We received a request to reset the password for your account.
                            Click the button below to create a new password.
                        </p>

                        <!-- Button -->
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin:30px auto;">
                            <tr>
                                <td align="center" style="border-radius:6px; background-color:#2563eb;">
                                    <a href="{{RESET_URL}}"
                                       target="_blank"
                                       style="display:inline-block; padding:14px 28px; font-size:16px; font-weight:bold; color:#ffffff; text-decoration:none; border-radius:6px; background-color:#2563eb;">
                                        Reset Password
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 25px 0; font-size:14px; line-height:22px; color:#777777; text-align:center;">
                            This password reset link will expire for security reasons.
                        </p>

                        <!-- Fallback Link Section -->
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="width:100%; background-color:#f8fafc; border:1px solid #e5e7eb; border-radius:6px;">
                            <tr>
                                <td style="padding:20px;">

                                    <p style="margin:0 0 10px 0; font-size:14px; line-height:20px; color:#444444; font-weight:bold;">
                                        Can't use the button?
                                    </p>

                                    <p style="margin:0 0 10px 0; font-size:13px; line-height:20px; color:#666666;">
                                        Copy and paste the following link into your browser:
                                    </p>

                                    <p style="margin:0; padding:12px; background-color:#ffffff; border:1px solid #dddddd; border-radius:4px; font-size:13px; line-height:20px; color:#2563eb; word-break:break-all;">
                                        {{RESET_URL}}
                                    </p>

                                </td>
                            </tr>
                        </table>

                        <!-- Security Notice -->
                        <p style="margin:30px 0 0 0; font-size:14px; line-height:22px; color:#777777;">
                            If you did not request a password reset, you can safely ignore this email.
                            Your password will remain unchanged.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" style="padding:20px 30px; background-color:#f8fafc; border-top:1px solid #eeeeee;">

                        <p style="margin:0 0 5px 0; font-size:13px; line-height:20px; color:#888888;">
                            &copy; {{APP_NAME}}. All rights reserved.
                        </p>

                        <p style="margin:0; font-size:12px; line-height:18px; color:#aaaaaa;">
                            This is an automated email. Please do not reply to this message.
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>
```

</body>
</html>
