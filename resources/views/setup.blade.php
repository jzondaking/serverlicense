<!DOCTYPE html>
<html dir="ltr">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=yes" />
        <title>Cài đặt database | Server License</title>
        <link rel="stylesheet" href="https://www.gstatic.com/recaptcha/releases/4rwLQsl5N_ccppoTAwwwMrEN/demo__ltr.css" type="text/css" />
    </head>
    <body>
        <div class="sample-form">
            <form method="POST" action="{{ route('save_setup') }}">
                @csrf
                <fieldset>
                    <legend>Thông tin Database</legend>
                    <ul>
                        <li>
                            <b style="color: red;">{{ session('error') }}</b>
                        </li>
                        <li>
                            <label for="input1">Tên bảng</label>
                            <input class="jfk-textinput" id="input1" name="db_database" type="text" aria-disabled="true" />
                        </li>
                        <li>
                            <label for="input2">Người dùng</label>
                            <input class="jfk-textinput" id="input2" name="db_username" type="text" aria-disabled="true" />
                        </li>
                        <li>
                            <label for="input3">Mật khẩu</label>
                            <input class="jfk-textinput" id="input3" name="db_password" type="text"  aria-disabled="true" />
                        </li>
                        <li>
                            <input id="recaptcha-demo-submit" type="submit" value="Gửi" />
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </body>
</html>
