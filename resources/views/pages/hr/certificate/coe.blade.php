<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 800px;
            padding: 40px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .background-image {
            position: absolute;
            top: 35%;
            left: 50%;
            width: 100%;
            height: 100%;
            background: url('images/logo.png') no-repeat center center; 
            background-size: contain; 
            transform: translate(-50%, -50%); 
            opacity: 0.1; 
            z-index: 0;
            filter: blur(2px); 
        }

        .content-wrapper {
            position: relative;
            z-index: 1; 
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .content {
            margin-top: 20px;
            line-height: 1.8;
            text-align: justify;
        }

        .content p {
            margin: 0 0 15px;
        }

        .signature {
            margin-top: 80px;
            text-align: right;
            font-size: 16px;
        }

        .signature p {
            margin: 5px 0;
        }
        .date {
            text-align: right; 
            margin-bottom: 20px; 
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="background-image">
        </div>
        <div class="content-wrapper">
            <div class="header">
                <h2>CERTIFICATION</h2>
            </div>

            <div class="content">
                <p class="date"><strong>Date:</strong><u> {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</u></p>
                <p><strong>To Whom It May Concern:</strong></p>
                <p style="text-indent: 30px;">
                    This is to certify that <u><strong>{{ $name }}</strong></u> is a <u><strong>{{$employement_type}}</strong></u> employee of Cebu
                    Technological University – Tuburan Campus from <u><strong>{{$department}}</strong></u> to present and has no pending administrative nor criminal case
                    filed against him/her.
                </p>
                <p style="text-indent: 30px;">
                    This certification is issued to <u><strong>{{ $name }}</strong></u> upon his/her request for whatever purpose this may serve him/her best.
                </p>
            </div>

            <div class="signature">
                <p><u><strong>CRISTY XILDE R. AMANCIO, RPm</strong></u></p>
                <p>Administrative Officer IV/HRMO II</p>
            </div>
        </div>
    </div>
</body>
</html>
