  <footer id="footer" class="">
      <div class="link-list-row">
          <div class="container no-padding">
              <div class="col-xs-12 col-md-4 ">
                  <div class="contact-info">
                      <div class="footer-logo text-center">
                          <img src="<?=isset($site_logo) ? BASE_URL.$site_logo : ''?>" alt="GSM server Free Firmware" />
                      </div>

                      <p>
                          <?=isset($footer_contact) ? $footer_contact : ''?>
                      </p>


                      <div class="social-icons text-center">
                          <ul>
                              <li>
                                  <a target="_blank" href="<?=isset($facebook_url) ? $facebook_url : ''?>"
                                      class="fa fa-lg fa-facebook bg-light-blue"></a>
                              </li>
                              <li>
                                  <a target="_blank" href="<?=isset($youtube_url) ? $youtube_url : ''?>"
                                      class="fa fa-lg fa-youtube bg-red"></a>
                              </li>
                              <li>
                                  <a target="_blank" href="<?=isset($twitter_url) ? $twitter_url : ''?>"
                                      class="fa fa-lg fa-twitter bg-aqua"></a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-xs-12 col-md-8 no-margin">
                  <div class="link-widget">
                      <div class="widget">
                          <ul>
                              <li><a href="<?=BASE_URL?>">Home</a></li>
                              <li><a href="download.html">Download</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="link-widget">
                      <div class="widget">
                          <ul>
                              <li><a
                                      href="page/Privacy-Policyda37.html?pid=eyJpdiI6ImFcL1lqbmREUTYyaUswU0VmOHdCeEN3PT0iLCJ2YWx1ZSI6IkpLbUVER09ta2g4U1dyXC9Ucml6ME5RPT0iLCJtYWMiOiI2NzFmYTdhYWZlMzdlNDkzOWFkMmY4OTk4YjQ5ZGI2NTY2OTlmNzFhMTMzYWE3MjdiNjY2ZjNiNDRkODc0NDM4In0=">GTM
                                      Privacy Policy</a></li>
                              <li><a
                                      href="page/online-remote-term-privacy-policyafb5.html?pid=eyJpdiI6InBCbVNcL0N1V0w4QU1GVW80R1hnT0hBPT0iLCJ2YWx1ZSI6Ikt2Ymc4N3BFaWRWMnptVVNNRldkK0E9PSIsIm1hYyI6Ijc3N2M1NGQ2NjUxMzdkNmEyMjg0ZGE0YTdmNThjNzJmOGE4NDNmY2E1ZWJkNWVmZjdmZDcyNjQ1ZGU1MDVmNDgifQ==">Remote
                                      Service Terms &amp; Policy</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="copyright-bar">
          <div class="container">
              <div class="col-md-6 col-sm-6 col-xs-12 no-margin">
                  <div class="copyright">
                      <?=isset($copyright) ? $copyright : ''?> <br>
                      <?=isset($footer_text) ? $footer_text : ''?>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 no-margin">
                  <div class="payment-methods ">
                      <ul>
                          <li>
                              <img alt="Visa Card" src="<?=BASE_URL?>uploads/payments/payment-visa.png">
                          </li>
                          <li>
                              <img alt="Master Card" src="<?=BASE_URL?>uploads/payments/payment-master.png">
                          </li>
                          <li>
                              <img alt="Payple" src="<?=BASE_URL?>uploads/payments/payment-paypal.png">
                          </li>
                          <li>
                              <img alt="Skirll" src="<?=BASE_URL?>uploads/payments/payment-skrill.png">
                          </li>

                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </footer>