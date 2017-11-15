<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/register.css"> 
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
                <div class="col-sm-12">
                <div class="user">

                    <form class="form" method="post" action="<?php echo base_url(); ?>index.php/Login/on_register">

                        <div class="form__group">
                            <input type="email" placeholder="Email" class="form__input" name="email" required/>
                        </div>

                        <div class="form__group">
                            <input type="password" placeholder="Password" class="form__input" name="password" required />
                        </div>

                        <div class="form__group">
                            <input type="text" placeholder="Name" class="form__input" name="name" required/>
                        </div>

                        <div class="form__group">
                            <input type="text" placeholder="Company Name" class="form__input" name="company_name" required />
                        </div>

                        <button class="btn" type="submit">Register</button>
                        <div class="form__group" style="margin-left: 25px;">
                            <a class="form__input" href="<?php echo base_url(); ?>">Already have an account ? Login Here</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
