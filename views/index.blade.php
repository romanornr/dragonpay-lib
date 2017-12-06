<!doctype html>
<html lang="en">

<head>
    <title>Payment</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <!-- <link rel="stylesheet" href="vendor/DragonPay/css/style.css">-->
    <link rel="stylesheet" href="{!! asset('vendor/DragonPay/css/style.css') !!}">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="payment-text">Waiting for payment <div class="payment-time">14m 51s</div></a>
        <a href="#" class="btn btn-secondary btn-cancel" role="button">Cancel</a>

    </nav>
    <br>
    <div class="container">

        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="card payment-card">
                    <div class="card-block">

                        <div class="payment-logo">
                           <!-- <img src="https://halongmining.com/wp-content/uploads/2017/11/cropped-Website-Header-v1a_full_width-2-1.jpg">-->
                        </div>
                        <div class="payment-info">
                            <div class="card-title payment-title">Halong mining</div>
                            <div class="payment-price">180.29 EUR</div>
                            <p class="text-muted ordernumber">Order 626fdb52ee5c913a5e0</p>
                        </div>
                        <div class="payment-section">
                            <a class="payment-info-text">
              Do not pay this invoice from Coinbase wallet or a bitcoin exchange account. Exchanges and especially Coinbase do not broadcast the bitcoin payment in time, thus resulting in failure. Use the following bitcoin wallets instead: Trezor, Ledger, samouraiwallet, Copay, Electrum, Greenadress. 
              </a>
                            <div class="media">
                                <div class="media-left payment-qr">
                                    <img class="media-object" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" width="200px">
                                </div>
                                <div class="media-body payment-details text-muted">
                                    Send <span class="payment-details-styled">0.02615909</span> bitcoin
                                    <br> to this bitcoin address
                                    <br>
                                    <span class="payment-details-styled">{{ $paymentAddress }}</span>
                                    <br>
                                    <a href="#" class="btn btn-secondary" role="button">Need Help</a>
                                    <a href="#" class="btn btn-primary" role="button">Pay from wallet</a>

                                </div>

                                <!--
              <div class="payment-qr">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png">
              </div>
              <div class="payment-details">
                  Send <span class="payment-details-styled">0.02615909</span> bitcoin to this address <span class="payment-details-styled">16rCmCmbuWDhPjWTrpQGaU3EPdZF7MTdUk</span>
              </div>
-->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>