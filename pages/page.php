<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akman Tourism</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #A6D0DD;
            transition: .5s;
        }

        body.active {
            background: #03a9f4;
        }

        .container {
            position: relative;
            width: 800px;
            height: 500px;
            margin: 20px;
        }

        .blueBG {
            position: absolute;
            top: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 420px;
            background: rgba(255, 255, 255, .2);
            box-shadow: 0 5px 45px rgba(0, 0, 0, .15);
        }

        .blueBG .box {
            position: relative;
            width: 50%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .form-box {
            position: absolute;
            background: #fff;
            height: 100%;
            width: 50%;
            top: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 5px 45px rgba(0, 0, 0, 0.25);
            transition: ease-in-out .5s;
            overflow: hidden;

        }

        .form-box.active {
            left: 50%;
        }

        .box h2 {
            color: #fff;
            font-size: 1.2em;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .blueBG .box button {
            padding: 10px 20px;
            background: #fff;
            color: #000;
            font-size: 16px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .form-box .form {
            position: absolute;
            width: 80%;
            transition: .5s;
            padding: 50px;
        }

        .form-box .signinform {
            transition-delay: .25s;
        }

        .form-box.active .signinform {
            left: -100%;
            transition-delay: 0;
        }

        .form-box .signupform {
            left: 100%;
            transition-delay: 0;
        }

        .form-box.active .signupform {
            left: 0%;
            transition-delay: .25s;
        }

        .form-box .form form {
            display: flex;
            width: 100%;
            flex-direction: column;
        }

        .form-box .form form input {
            margin-bottom: 20px;
            height: 30px;
            padding: 10px;
            outline: none;
            font-size: 16px;
            border: 1px solid #333;
            border: 1.5px solid;
        }

        .form form h3 {
            text-align: center;
            font-size: 1.5em;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .form form input[value="Sign Up"] {
            background: #03a9f4;
            border: none;
            max-width: 100px;
            color: #fff;
            cursor: pointer;
        }

        a {
            color: #333;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="blueBG">
            <div class="box signin">
                <h2>Already Have An Account?</h2>
                <button class="signinbtn">Sign In</button>
            </div>
            <div class="box signup">
                <h2>Create An Account?</h2>
                <button class="signupbtn">Register</button>
            </div>
        </div>
        <div class="form-box">
            <div class="form signinform">
                <form action="../determination/login.php" method="post">
                    <h3>Sign In</h3>
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Sign In">
                </form>
            </div>
            <div class="form signupform">
                <form action="../determination/register.php" method="post">
                    <h3>Sign Up</h3>
                    <input type="email" id="email" name="email" required placeholder="Email Address">
                    <input type="password" id="password" name="password" required placeholder="Password">
                    <input type="text" id="username" name="username" required placeholder="Username"> <!-- Added username input field -->
                    <input type="submit" value="Sign Up">
                </form>
            </div>
        </div>
    </div>
    <script>
        const signinbtn = document.querySelector('.signinbtn');
        const signupbtn = document.querySelector('.signupbtn');
        const formbox = document.querySelector('.form-box');
        const body = document.querySelector('body');
        signupbtn.onclick = function() {
            formbox.classList.add('active');
            body.classList.add('active');
        };
        signinbtn.onclick = function() {
            formbox.classList.remove('active');
            body.classList.remove('active');
        };
    </script>
    <script>
        // Check if the URL contains the success parameter
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');

        if (success) {
            // Create a pop-up message
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.textContent = 'Registration successful!';

            // Append the pop-up message to the body
            document.body.appendChild(popup);

            // Remove the pop-up message after 3 seconds
            setTimeout(() => {
                document.body.removeChild(popup);
            }, 3000);
        }
    </script>
    <script>
    (function() {
        // Check if the URL contains the login parameter
        const urlParams = new URLSearchParams(window.location.search);
        const loginStatus = urlParams.get('login');

        if (loginStatus === 'success') {
            // Create a pop-up message for successful login
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.textContent = 'Login successful!';

            // Append the pop-up message to the body
            document.body.appendChild(popup);

            // Remove the pop-up message after 3 seconds
            setTimeout(() => {
                document.body.removeChild(popup);
            }, 3000);
        } else if (loginStatus === 'failed') {
            // Create a pop-up message for failed login
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.textContent = 'Invalid email or password';

            // Append the pop-up message to the body
            document.body.appendChild(popup);

            // Remove the pop-up message after 3 seconds
            setTimeout(() => {
                document.body.removeChild(popup);
            }, 3000);
        }
    })();
</script>

</body>

</html>
