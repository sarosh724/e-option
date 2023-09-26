<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style type="text/css">
    a[x-apple-data-detectors] {color: inherit !important;}

    #email-header {
        padding: 30px;
        font-size: 1.1rem;
        text-align: center;
    }

    #email-header img {
        width: auto;
        max-width: 125px;
    }

    #email-header .header-logo { max-height: 60px;}
    .btn { padding: 7px; }
    .btn-green { background-color:#007f3d; color:#FFF; font-weight: bold; text-align: center; }

    a.btn-green { color:#FFF !important; text-decoration: none; }
    #email-footer { padding: 25px; font-size: .6rem; text-align: center; background-color: #FFF; }

    #email-outer-wrapper { font-family: arial; max-width: 750px; margin: 0 auto; }
    #email-inner-wrapper { padding : 15px;  }
    #email-content { margin: 10px; padding: 10px; }
    #email-footer { margin: 10px; padding: 10px; }

    table { width: 100%; }
    table td, table th { padding: 5px; }

    .text-right { text-align: right; }
    .text-left { text-align: left; }

  </style>

</head>
<body style="margin: 0; padding: 0;">

    <div id="email-outer-wrapper">
        <div id="email-header">
            <img src="{{asset('assets/images/osss-logo.png')}}" alt="Easy Option" style="max-width:125px;">
        </div>
        <div id="email-inner-wrapper">
            <div id="email-content">
                @yield('email.content')
            </div>
            <div id="footer-content">
                @yield('email.sender')
            </div>
        </div>
        <div id="email-footer">
            This email is generated by Easy Option.
        </div>
    </div>
</body>
</html>