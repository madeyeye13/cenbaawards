<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body { font-family: 'Georgia', serif; background: #f5f0e8; margin: 0; padding: 40px 20px; color: #1a1a1a; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; }
        .header { background: #8B0000; padding: 36px 40px; }
        .header h1 { color: #FBA320; font-size: 12px; letter-spacing: 0.3em; text-transform: uppercase; margin: 0 0 10px; font-family: sans-serif; font-weight: 600; }
        .header h2 { color: #ffffff; font-size: 26px; margin: 0; font-weight: normal; line-height: 1.3; }
        .body { padding: 36px 40px; }
        .body p { font-size: 15px; line-height: 1.85; color: #444444; margin-bottom: 16px; }
        .highlight { background: #f5f0e8; border-left: 3px solid #FBA320; padding: 16px 20px; margin: 24px 0; font-size: 14px; color: #555; line-height: 1.7; }
        .btn { display: inline-block; background: #8B0000; color: #ffffff; text-decoration: none; padding: 14px 32px; font-size: 11px; font-family: sans-serif; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; margin-top: 8px; }
        .divider { border: none; border-top: 1px solid #e8e0d0; margin: 28px 0; }
        .footer { background: #1a1a1a; padding: 24px 40px; text-align: center; }
        .footer p { color: #666; font-size: 11px; font-family: sans-serif; margin: 4px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>CenBa Africa Business Excellence Awards</h1>
            <h2>Thank You, {{ $contact->name }}.</h2>
        </div>
        <div class="body">
            <p>We have received your message and appreciate you reaching out to us.</p>
            <p>Our team will review your enquiry and respond within <strong>2–3 business days</strong>. Please do not send duplicate messages as this may delay our response.</p>

            <div class="highlight">
                <strong>Your message:</strong><br><br>
                {{ $contact->message }}
            </div>

            <hr class="divider">

            <p>In the meantime, you can learn more about the CenBa Africa Business Excellence Awards — celebrating Africa's finest businesses since 2016.</p>

            <a href="{{ config('app.url') }}" class="btn">Visit Our Website</a>
        </div>
        <div class="footer">
            <p><strong style="color: #FBA320;">CenBa Africa Business Excellence Awards</strong></p>
            <p>info@cenbabusinessaward.com</p>
            <p style="margin-top: 8px; color: #444;">This is an automated response. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>