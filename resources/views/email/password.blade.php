<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
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
                                We received a request to reset your password for your HabingIbaan account. Click the button below to create a new password:
                            </p>
                            
                            <!-- Reset Password Button -->
                            <div style="text-align: center; margin: 40px 0;">
                                <a href="{{ $verificationLink }}" style="display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 100%); color: #ffffff; text-decoration: none; border-radius: 8px; font-size: 16px; font-weight: bold; box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);">
                                    Reset Password
                                </a>
                            </div>

                            <!-- Alternative Link -->
                            <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; padding: 20px; margin: 30px 0; border-radius: 6px;">
                                <p style="margin: 0 0 10px; color: #666666; font-size: 14px; line-height: 1.6;">
                                    If the button above doesn't work, copy and paste this link into your browser:
                                </p>
                                <p style="margin: 0; color: #ff6b35; font-size: 13px; word-break: break-all; font-family: 'Courier New', monospace;">
                                    {{ $verificationLink }}
                                </p>
                            </div>

                            <p style="margin: 20px 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                This password reset link will expire in 60 minutes for security reasons. If you didn't request a password reset, please ignore this email and your password will remain unchanged.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f8f8; padding: 30px; text-align: center; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0 0 10px; color: #999999; font-size: 12px; line-height: 1.6;">
                                This is an automated message, please do not reply.
                            </p>
                            <p style="margin: 0; color: #999999; font-size: 12px; line-height: 1.6;">
                                © 2025 HabingIbaan. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>