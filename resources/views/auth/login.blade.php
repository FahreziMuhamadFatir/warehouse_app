<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAREHOUSE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: rgb(104, 90, 81);
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 20px;
        }

        .form-container {
            display: flex;
            width: 800px;
            height: 500px;
            border: 3px solid white;
            border-radius: 30px;
            backdrop-filter: blur(20px);
            overflow: hidden;
        }

        .col-1 {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 55%;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(30px);
            border-radius: 0 30% 20% 0;
            transition: border-radius .3s;
        }

        .image-layer {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .form-image-main {
            max-width: 100%;
            max-height: 100%;
            z-index: 1;
        }

        .palu {
            position: absolute;
            bottom: 320px;
            left: 210px;
            width: 50px;
            z-index: 2;
            animation: scale-down 3s ease-in-out alternate infinite;
        }

        .meteran {
            position: absolute;
            bottom: 250px;
            right: 120px;
            width: 50px;
            z-index: 2;
            animation: scale-down 3s ease-in-out alternate infinite;
        }

        @keyframes scale-down {
            to {
                transform: scale(0.95);
            }
        }

        .col-2 {
            position: relative;
            width: 45%;
            padding: 20px;
            overflow: hidden;
        }

        .btn-box {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn {
            font-weight: 500;
            padding: 5px 30px;
            border: none;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .btn-1 {
            background: #21264D;
        }

        .form-title {
            margin: 20px 0;
            color: #fff;
            font-size: 22px;
            font-weight: 600;
            text-align: center;
        }

        .form-inputs {
            width: 100%;
        }

        .input-box {
            position: relative;
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            height: 55px;
            padding: 0 15px;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 10px;
            outline: none;
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        ::placeholder {
            color: #fff;
            font-size: 14px;
        }

        .input-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            height: 40px;
            font-size: 14px;
            color: #fff;
            background: #21264D;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: .3s;
        }

        .input-submit:hover {
            gap: 15px;
        }

        @media (max-width: 892px) {
            .form-container {
                width: 400px;
                flex-direction: column;
            }
            .col-1 {
                display: none;
            }
            .col-2 {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="col-1">
            <div class="image-layer">
                <img src="{{ asset('uploads/org.png') }}" class="form-image-main">
                <img src="{{ asset('uploads/palu.png') }}" class="form-image palu">
                <img src="{{ asset('uploads/meteran.png') }}" class="form-image meteran">
            </div>
        </div>
        <div class="col-2">
            <div class="btn-box">
                <button class="btn btn-1">Sign In</button>
            </div>
            <form action="{{ route('login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-title"><span>Sign In</span></div>
                <div class="form-inputs">
                    <div class="input-box">
                        <input type="text" name="username" class="input-field" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password" required>
                    </div>
                    <div class="input-box">
                        <button type="submit" class="input-submit">
                            <span>Sign In</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
