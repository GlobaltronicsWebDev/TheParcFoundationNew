<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f7;
            color: #333333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background: #111111;
            padding: 24px;
            text-align: center;
            border-bottom: 4px solid #f99f1b;
        }
        .header h2 {
            color: #ffffff;
            margin: 0;
            font-size: 22px;
            letter-spacing: 0.5px;
        }
        .header span {
            color: #f99f1b;
        }
        .header p {
            color: #aaaaaa;
            margin: 6px 0 0 0;
            font-size: 13px;
        }
        .content {
            padding: 30px;
        }
        .field-group {
            margin-bottom: 18px;
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 12px;
        }
        .field-group:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #888888;
            font-weight: 700;
            letter-spacing: 0.8px;
        }
        .value {
            font-size: 15px;
            color: #222222;
            margin-top: 4px;
            font-weight: 500;
        }
        .message-box {
            background: #f9f9f9;
            border-left: 4px solid #f99f1b;
            padding: 15px;
            font-size: 14px;
            border-radius: 4px;
            white-space: pre-wrap;
            word-break: break-word;
            color: #333333;
            line-height: 1.6;
            margin-top: 6px;
        }
        .footer {
            background: #fafafa;
            padding: 16px;
            text-align: center;
            font-size: 12px;
            color: #888888;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>THE PARC <span>FOUNDATION</span></h2>
            <p>New Contact Form Inquiry</p>
        </div>
        <div class="content">
            <div class="field-group">
                <div class="label">Sender Name</div>
                <div class="value">{{ $data['first_name'] }} {{ $data['last_name'] }}</div>
            </div>
            <div class="field-group">
                <div class="label">Email Address</div>
                <div class="value">
                    <a href="mailto:{{ $data['email'] }}" style="color: #f99f1b; text-decoration: none; font-weight: bold;">
                        {{ $data['email'] }}
                    </a>
                </div>
            </div>
            <div class="field-group">
                <div class="label">Phone Number</div>
                <div class="value">{{ !empty($data['phone']) ? $data['phone'] : 'N/A' }}</div>
            </div>
            <div class="field-group">
                <div class="label">Subject / Inquiry Type</div>
                <div class="value">{{ $data['subject'] }}</div>
            </div>
            <div class="field-group">
                <div class="label">Message</div>
                <div class="message-box">{{ $data['message'] }}</div>
            </div>
            <div class="field-group">
                <div class="label">Subscription Preferences</div>
                <div class="value">
                    Email Updates: <strong>{{ ucfirst($data['email_updates'] ?? 'yes') }}</strong> &bull; 
                    Text Updates: <strong>{{ ucfirst($data['text_updates'] ?? 'no') }}</strong>
                </div>
            </div>
        </div>
        <div class="footer">
            This message was submitted via the PARC Foundation Contact Us form on {{ now()->format('F j, Y \a\t g:i A') }}.
        </div>
    </div>
</body>
</html>
