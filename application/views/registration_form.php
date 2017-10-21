<html>
    <head>
        <style type="text/css">

                * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                }

                body {
                font-family: "Roboto";
                font-size: 14px;
                background-size: 200% 100% !important;
                animation: move 10s ease infinite;
                transform: translate3d(0, 0, 0);
                background: linear-gradient(45deg, #49D49D 10%, #A2C7E5 90%);
                height: 100vh
                }

                .user {
                width: 90%;
                max-width: 340px;
                margin: 10vh auto;
                }

                .user__header {
                text-align: center;
                opacity: 0;
                transform: translate3d(0, 500px, 0);
                animation: arrive 500ms ease-in-out 0.7s forwards;
                }

                .user__title {
                font-size: 14px;
                margin-bottom: -10px;
                font-weight: 500;
                color: white;
                }

                .form {
                margin-top: 40px;
                border-radius: 6px;
                overflow: hidden;
                opacity: 0;
                transform: translate3d(0, 500px, 0);
                animation: arrive 500ms ease-in-out 0.9s forwards;
                }

                .form--no {
                animation: NO 1s ease-in-out;
                opacity: 1;
                transform: translate3d(0, 0, 0);
                }

                .form__input {
                display: block;
                width: 100%;
                padding: 20px;
                font-family: "Roboto";
                -webkit-appearance: none;
                border: 0;
                outline: 0;
                transition: 0.3s;

                &:focus {
                    background: darken(#fff, 3%);
                }
                }

                .btn {
                display: block;
                width: 100%;
                padding: 20px;
                font-family: "Roboto";
                -webkit-appearance: none;
                outline: 0;
                border: 0;
                color: white;
                background: #ABA194;
                transition: 0.3s;

                &:hover {
                    background: darken(, 5%);
                }
                }

                @keyframes NO {
                from, to {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
                }

                10%, 30%, 50%, 70%, 90% {
                -webkit-transform: translate3d(-10px, 0, 0);
                transform: translate3d(-10px, 0, 0);
                }

                20%, 40%, 60%, 80% {
                -webkit-transform: translate3d(10px, 0, 0);
                transform: translate3d(10px, 0, 0);
                }
                }

                @keyframes arrive {
                0% {
                    opacity: 0;
                    transform: translate3d(0, 50px, 0);
                }

                100% {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
                }

                @keyframes move {
                0% {
                    background-position: 0 0
                }

                50% {
                    background-position: 100% 0
                }

                100% {
                    background-position: 0 0
                }
                }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $('.btn').on('click', function () {
            $('.form').addClass('form--no');
        });
        </script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="user">

                    <form class="form" method="post" action="http://localhost/cip/index.php/Login/on_register">

                        <div class="form__group">
                            <input type="email" placeholder="Email" class="form__input" name="email"/>
                        </div>

                        <div class="form__group">
                            <input type="password" placeholder="Password" class="form__input" name="password" />
                        </div>

                        <div class="form__group">
                            <input type="text" placeholder="Name" class="form__input" name="name" />
                        </div>

                        <div class="form__group">
                            <input type="text" placeholder="Company Name" class="form__input" name="company_name" />
                        </div>

                        <button class="btn" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
