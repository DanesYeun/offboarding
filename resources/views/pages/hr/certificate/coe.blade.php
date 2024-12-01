<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Employment</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .certificate {
            width: 700px;
            padding: 30px;
            border: 8px solid #0056b3;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            text-align: center;
            box-sizing: border-box;
            border-radius: 8px;
        }

        .certificate-header {
            font-size: 14px;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .certificate-header h1 {
            font-size: 26px;
            color: #0056b3;
            margin: 0;
            font-weight: bold;
        }

        .certificate-header p {
            font-size: 14px;
            margin: 5px 0;
            font-weight: normal;
        }

        .certificate-title {
            font-size: 32px;
            color: #333;
            margin: 30px 0 20px 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .certificate-content {
            font-size: 18px;
            color: #444;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .certificate-content .name {
            font-size: 28px;
            color: #0056b3;
            font-weight: bold;
            text-decoration: underline;
            margin: 10px 0;
        }

        .certificate-footer {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        .signature {
            margin-top: 40px;
        }

        .signature .line {
            border-top: 1px solid #333;
            width: 200px;
            margin: 15px auto;
        }

        .signature p {
            margin-top: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .border {
            border: 5px solid #0056b3;
            padding: 25px;
            box-sizing: border-box;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <div class="border">
            <div class="certificate-header">
                <h1>CEBU TECHNOLOGICAL UNIVERSITY TUBURAN CAMPUS</h1>
                <p>Brgy 8, Poblacion Tuburan, Cebu, Philippines</p>
                <p>Phone: +6332 463 9313 loc. 1523 | Email: tuburan.campus@ctu.edu.ph</p>
            </div>
            <div class="certificate-title">
                Certificate of Employment
            </div>
            <div class="certificate-content">
                <p class="name">{{ $name }}</p>
                <p>In recognition of your exceptional contributions and dedicated service as a {{ $job_title }}.</p>
                <p>Departure Date: {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</p>
            </div>
            <div class="certificate-footer">
                <div class="signature">
                    <div class="line"></div>
                    <p>MA. Carla Y. Abaquita, Dev.Ed.D., RChE</p>
                    <p>Campus Director</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
