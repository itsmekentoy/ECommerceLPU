<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Notification</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">Password Reset</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                Hello,
                            </p>
                            <p style="margin: 0 0 20px; color: #333333; font-size: 16px; line-height: 1.6;">
                                Your password has been successfully reset. Your new temporary password is:
                            </p>
                            
                            <!-- Password Box -->
                            <div style="background-color: #fff5f0; border-left: 4px solid #ff6b35; padding: 20px; margin: 30px 0; border-radius: 4px;">
                                <p style="margin: 0 0 8px; color: #666666; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">New Password</p>
                                <p style="margin: 0; color: #ff6b35; font-size: 24px; font-weight: bold; font-family: 'Courier New', monospace; word-break: break-all;">
                                    {{ $password }}
                                </p>
                            </div>

                            <p style="margin: 20px 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                If you didn't request this password reset, please contact our support team immediately.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f8f8; padding: 30px; text-align: center; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0 0 10px; color: #999999; font-size: 12px; line-height: 1.6;">
                                This is an automated message, please do not reply.
                            </p>
                            
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>