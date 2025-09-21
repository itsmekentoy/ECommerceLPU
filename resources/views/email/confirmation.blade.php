<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to HabingIbaan</title>
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
                                    Welcome to HabingIbaan! {{ $name }}
                                </h2>
                            </div>
                            
                            
                            
                            <!-- Thank You Message -->
                            <div style="background-color: #f8fafc; border-left: 4px solid #c2410c; padding: 20px; margin: 30px 0; border-radius: 0 8px 8px 0;">
                                <p style="color: #374151; font-size: 16px; margin: 0; font-weight: 500;">
                                    🎉 Thank you for creating your account!
                                </p>
                                <p style="color: #6b7280; font-size: 14px; margin: 10px 0 0 0;">
                                    We're excited to have you join our community.
                                </p>
                            </div>
                            
                            <!-- Call to Action -->
                            <div style="text-align: center; margin: 40px 0;">
                                <p style="color: #374151; font-size: 16px; margin: 0 0 20px 0;">
                                    To complete your registration and activate your account, please click the button below:
                                </p>
                                
                                <!-- CTA Button -->
                                <a href="{{ $verificationLink }}" style="display: inline-block; background: linear-gradient(135deg, #ea580c, #c2410c); color: #ffffff; text-decoration: none; padding: 15px 35px; border-radius: 50px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 12px rgba(194, 65, 12, 0.3); transition: all 0.3s ease;">
                                    Activate Your Account
                                </a>
                                
                                <!-- Alternative Link -->
                                <p style="color: #6b7280; font-size: 14px; margin: 20px 0 0 0;">
                                    Can't click the button? Copy and paste this link into your browser:<br>
                                    <a href="{{ $verificationLink }}" style="color: #c2410c; word-break: break-all;">{{ $verificationLink }}</a>
                                </p>
                            </div>
                            
                            <!-- Additional Info -->
                            <div style="background-color: #fef3c7; border-radius: 8px; padding: 20px; margin: 30px 0;">
                                <h3 style="color: #92400e; font-size: 16px; font-weight: 600; margin: 0 0 10px 0;">
                                    📋 What's Next?
                                </h3>
                                <ul style="color: #a16207; font-size: 14px; margin: 0; padding-left: 20px;">
                                    <li style="margin-bottom: 5px;">Verify your email address</li>
                                    <li style="margin-bottom: 5px;">Complete your profile</li>
                                    <li style="margin-bottom: 5px;">Explore our features</li>
                                </ul>
                            </div>
                            
                            <!-- Security Note -->
                            <div style="border-top: 1px solid #e5e7eb; padding-top: 20px; margin-top: 30px;">
                                <p style="color: #6b7280; font-size: 12px; margin: 0; text-align: center;">
                                    🔒 This activation link will expire in 24 hours for your security.<br>
                                    If you didn't create this account, please ignore this email.
                                </p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 30px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="color: #6b7280; font-size: 14px; margin: 0 0 10px 0;">
                                Need help? Contact our support team
                            </p>
                            <p style="color: #6b7280; font-size: 12px; margin: 0 0 15px 0;">
                                📧 support@habingibaan.com | 📞 +63-XXX-XXX-XXXX
                            </p>
                            
                            <!-- Social Links -->
                            <div style="margin: 15px 0;">
                                <a href="#" style="display: inline-block; margin: 0 10px; color: #c2410c; text-decoration: none;">Facebook</a>
                                <a href="#" style="display: inline-block; margin: 0 10px; color: #c2410c; text-decoration: none;">Website</a>
                            </div>
                            
                            <p style="color: #9ca3af; font-size: 11px; margin: 15px 0 0 0;">
                                © 2024 HabingIbaan. All rights reserved.<br>
                                123 Main Street, Ibaan, Batangas, Philippines
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>