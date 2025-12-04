<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Login - HabingIbaan</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Arial', sans-serif; background-color: #f8f9fa; line-height: 1.6;">
    <!-- Email Container -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f8f9fa; padding: 20px 0;">
        <tr>
            <td align="center">
                <!-- Email Content -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #ea580c, #c2410c, #9a340a); padding: 40px 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                Habing<span style="color: #fed7aa;">Ibaan</span>
                            </h1>
                        </td>
                    </tr>
                    
                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <!-- Welcome Message -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <h2 style="color: #1f2937; font-size: 24px; font-weight: 600; margin: 0 0 10px 0;">
                                    Verify Your Login
                                </h2>
                                <p style="color: #6b7280; font-size: 16px; margin: 0;">
                                    Two-Factor Authentication
                                </p>
                            </div>
                            
                            <!-- Security Alert -->
                            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 20px; margin: 30px 0; border-radius: 0 8px 8px 0;">
                                <p style="color: #92400e; font-size: 16px; margin: 0; font-weight: 500;">
                                    🔐 Login Verification Required
                                </p>
                                <p style="color: #a16207; font-size: 14px; margin: 10px 0 0 0;">
                                    We detected a login attempt to your HabingIbaan account. To complete the login, please use the verification code below.
                                </p>
                            </div>
                            
                            <!-- OTP Code -->
                            <div style="text-align: center; margin: 40px 0;">
                                <p style="color: #374151; font-size: 16px; margin: 0 0 20px 0; font-weight: 500;">
                                    Your verification code is:
                                </p>
                                
                                <!-- OTP Display Box -->
                                <div style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); border: 2px solid #d1d5db; padding: 30px; border-radius: 12px; margin: 20px 0; display: inline-block;">
                                    <p style="color: #1f2937; font-size: 48px; font-weight: 700; margin: 0; letter-spacing: 8px; font-family: 'Courier New', monospace;">
                                        {{ $otp }}
                                    </p>
                                </div>
                                
                                <!-- Expiration Notice -->
                                <p style="color: #ef4444; font-size: 14px; margin: 20px 0 0 0; font-weight: 600;">
                                    ⏱ This code expires in 10 minutes
                                </p>
                            </div>
                            
                            <!-- Instructions -->
                            <div style="background-color: #ecfdfd; border-left: 4px solid #06b6d4; padding: 20px; margin: 30px 0; border-radius: 0 8px 8px 0;">
                                <h3 style="color: #164e63; font-size: 16px; font-weight: 600; margin: 0 0 10px 0;">
                                    How to proceed:
                                </h3>
                                <ol style="color: #1e7a8a; font-size: 14px; margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 8px;">Return to the login page on HabingIbaan</li>
                                    <li style="margin-bottom: 8px;">Enter the 6-digit verification code above</li>
                                    <li style="margin-bottom: 8px;">Click "Verify" to complete your login</li>
                                </ol>
                            </div>
                            
                            <!-- Security Warning -->
                            <div style="background-color: #fee2e2; border-radius: 8px; padding: 20px; margin: 30px 0;">
                                <p style="color: #991b1b; font-size: 12px; margin: 0; font-weight: 600;">
                                    ⚠️ Security Reminder:
                                </p>
                                <ul style="color: #b91c1c; font-size: 12px; margin: 10px 0 0 0; padding-left: 20px;">
                                    <li>Never share this code with anyone, not even HabingIbaan staff</li>
                                    <li>HabingIbaan will never ask for your verification code via email</li>
                                    <li>If you didn't attempt to login, please secure your account immediately</li>
                                </ul>
                            </div>
                            
                            <!-- Additional Info -->
                            <div style="border-top: 1px solid #e5e7eb; padding-top: 20px; margin-top: 30px;">
                                <p style="color: #6b7280; font-size: 12px; margin: 0; text-align: center;">
                                    If you didn't request this code, you can ignore this email.<br>
                                    Your account security is important to us.
                                </p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #9ca3af; font-size: 11px; margin: 15px 0 0 0;">
                                © 2024 HabingIbaan. All rights reserved.<br>
                                SM Sunrise Weaving Association, Ibaan, Batangas, Philippines
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
