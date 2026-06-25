<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body { font-family: 'Georgia', serif; background: #f5f0e8; margin: 0; padding: 40px 20px; color: #1a1a1a; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; }
        .header { background: #8B0000; padding: 36px 40px; }
        .header h1 { color: #FBA320; font-size: 13px; letter-spacing: 0.25em; text-transform: uppercase; margin: 0 0 8px; font-family: sans-serif; font-weight: 600; }
        .header h2 { color: #ffffff; font-size: 24px; margin: 0; font-weight: normal; }
        .body { padding: 36px 40px; }
        .label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.2em; color: #999999; font-family: sans-serif; margin-bottom: 4px; }
        .value { font-size: 15px; color: #1a1a1a; margin-bottom: 20px; line-height: 1.6; }
        .message-box { background: #f5f0e8; border-left: 3px solid #8B0000; padding: 16px 20px; margin-top: 8px; }
        .divider { border: none; border-top: 1px solid #e8e0d0; margin: 24px 0; }
        .footer { background: #1a1a1a; padding: 20px 40px; text-align: center; }
        .footer p { color: #666; font-size: 11px; font-family: sans-serif; margin: 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>New Contact Message</h1>
            <h2>CenBa Awards Website</h2>
        </div>
        <div class="body">
            <p style="font-size: 14px; color: #555; margin-top: 0;">A new message was submitted through the contact form.</p>
            <hr class="divider">

            <div class="label">Name</div>
            <div class="value">{{ $contact->name }}</div>

            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $contact->email }}" style="color: #8B0000;">{{ $contact->email }}</a></div>

            @if($contact->phone)
            <div class="label">Phone</div>
            <div class="value">{{ $contact->phone }}</div>
            @endif

            @if($contact->subject)
            <div class="label">Subject</div>
            <div class="value">{{ $contact->subject }}</div>
            @endif

            <div class="label">Message</div>
            <div class="message-box">{{ $contact->message }}</div>

            <hr class="divider">
            <p style="font-size: 12px; color: #999; font-family: sans-serif;">
                Received: {{ $contact->created_at->format('F j, Y \a\t g:i A') }}
            </p>
        </div>
        <div class="footer">
            <p>CenBa Africa Business Excellence Awards &mdash; Admin Notification</p>
        </div>
    </div>
</body>
</html>