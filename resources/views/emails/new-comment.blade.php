<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background:#f5f0e8; padding:24px; color:#333;">
    <div style="max-width:560px; margin:0 auto; background:#fff; border-top:4px solid #8B0000;">
        <div style="padding:24px 28px;">
            <h1 style="font-size:18px; color:#111; margin:0 0 4px;">New Comment Awaiting Approval</h1>
            <p style="font-size:13px; color:#888; margin:0 0 20px;">On: <strong>{{ $post->title }}</strong></p>

            <table style="width:100%; font-size:14px; border-collapse:collapse;">
                <tr><td style="padding:6px 0; color:#888; width:80px;">From:</td><td style="padding:6px 0; color:#111;">{{ $comment->author_name }}</td></tr>
                <tr><td style="padding:6px 0; color:#888;">Email:</td><td style="padding:6px 0; color:#111;">{{ $comment->author_email }}</td></tr>
            </table>

            <div style="margin:16px 0; padding:16px; background:#f9f7f4; border-left:3px solid #FBA320; font-size:14px; line-height:1.6; color:#444;">
                {{ $comment->body }}
            </div>

            <a href="{{ $moderateUrl }}" style="display:inline-block; margin-top:8px; background:#8B0000; color:#fff; text-decoration:none; padding:11px 24px; font-size:13px; font-weight:bold; border-radius:6px;">
                Review &amp; Approve
            </a>
        </div>
        <div style="padding:14px 28px; border-top:1px solid #eee; font-size:11px; color:#aaa;">
            CenBa Africa Business Excellence Awards — Comment Moderation
        </div>
    </div>
</body>
</html>