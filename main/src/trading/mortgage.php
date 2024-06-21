<?php
session_start();
session_regenerate_id(true); 

$error=0;
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true))
{
	header("Location: login.php"); 
	exit();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$mortgage_url = getenv('MORTGAGE_CALCULATOR_MODULE_URL');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Arcadia - Mortgage</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="css/main.css?version=4.4.0" rel="stylesheet">
    <link href="css/additional.css" rel="stylesheet">
    <link href="css/mortgage.css" rel="stylesheet">
<link href="icon_fonts_assets/picons-thin/style.css" rel="stylesheet">

  </head>
  <body class="menu-position-side menu-side-left full-screen with-content-panel">
    <div class="all-wrapper with-side-panel solid-bg-all">
      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="index.php"><img src="img/logo9.png"><span>F5 Forum</span></a>
            <div class="mm-buttons">
              <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
              </div>
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="img/Phillipe.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  Phillipe Cloup
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
            <!-- <li>
                <a href="accounts.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Accounts</span></a>
              </li> -->
              <li>
                <a href="stocks.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-bar-chart-stats-up"></div>
                  </div>
                  <span>Trading</span></a>
              </li>
              <li>
                <a href="mortgage.php">
                  <div class="icon-w">
                    <div class="os-icon os-icon-home"></div>
                  </div>
                  <span>Mortgage</span></a>
            </li>              
			  <li >
				<a href="logout.php">
				<div class="icon-w">
				  <div class="os-icon os-icon-signs-11"></div>
				</div>
				<span>Logout</span></a>
			  </li>
			 </ul>
			 <!--------------------
            END - Mobile Menu List
            -------------------->
          </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-dark color-style-bright menu-position-side menu-side-left menu-layout-mini sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
          <div class="logo-w" style="padding: 0px;">
            <a class="logo" href="index.php">
              <img src="img/logo9.png" style="width: 85px;">
              <div class="logo-label">
                F5 Forum
              </div>
            </a>
          </div>
         <h1 class="menu-page-header">
            Page Header
          </h1>
          <ul class="main-menu">
            <li class="sub-header">
              <span>Layouts</span>
            </li>
            <!-- <li>
              <a href="accounts.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Accounts</span></a>
            </li> -->
            <li>
              <a href="stocks.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-bar-chart-stats-up"></div>
                </div>
                <span>Trading</span></a>                
            </li>
            <li class="active">
              <a href="mortgage.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-home"></div>
                </div>
                <span>Mortgage</span></a>
            </li>            
			  <li >
				<a href="logout.php">
				<div class="icon-w">
				  <div class="os-icon os-icon-signs-11"></div>
				</div>
				<span>Logout</span></a>
			  </li>
          </ul>

        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-bright">

		  
		 <div class="fancy-selector-w">
          <div class="fancy-selector-current">
            <div class="fs-img">
              <img alt="" src="img/card1.png">
            </div>
            <div class="fs-main-info">
              <div class="fs-name">
                American Express Platinum
              </div>
              <div class="fs-sub">
                <span>Balance:</span><strong>$5,304</strong>
              </div>
            </div>
            <div class="fs-extra-info">
              <strong>5476</strong><span>ending</span>
            </div>
            <div class="fs-selector-trigger">
              <i class="os-icon os-icon-arrow-down4"></i>
            </div>
          </div>
          <div class="fancy-selector-options">
            <div class="fancy-selector-option">
              <div class="fs-img">
                <img alt="" src="img/card2.png">
              </div>
              <div class="fs-main-info">
                <div class="fs-name">
                  American Express Platinum
                </div>
                <div class="fs-sub">
                  <span>Balance:</span><strong>$5,304</strong>
                </div>
              </div>
              <div class="fs-extra-info">
                <strong>5476</strong><span>ending</span>
              </div>
            </div>
            <div class="fancy-selector-option active">
              <div class="fs-img">
                <img alt="" src="img/card1.png">
              </div>
              <div class="fs-main-info">
                <div class="fs-name">
                  Capital One Venture Card
                </div>
                <div class="fs-sub">
                  <span>Balance:</span><strong>$8,274</strong>
                </div>
              </div>
              <div class="fs-extra-info">
                <strong>2523</strong><span>ending</span>
              </div>
            </div>
            <div class="fancy-selector-option">
              <div class="fs-img">
                <img alt="" src="img/card3.png">
              </div>
              <div class="fs-main-info">
                <div class="fs-name">
                  CitiBank Preferred Credit
                </div>
                <div class="fs-sub">
                  <span>Balance:</span><strong>$1,202</strong>
                </div>
              </div>
              <div class="fs-extra-info">
                <strong>6345</strong><span>ending</span>
              </div>
            </div>
            <!-- <div class="fancy-selector-actions text-right">
              <a class="btn btn-warning" href="#"><i class="os-icon os-icon-ui-22"></i><span>Make Payment</span></a>
            </div> -->
          </div>
        </div>

            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              <div class="element-search autosuggest-search-activator">
                <input placeholder="Start typing to search..." type="text">
              </div>
              <!--------------------
              START - Messages Link in secondary top menu
              -------------------->
             <!--------------------
              END - Messages Link in secondary top menu
              --------------------><!--------------------
              START - Settings Link in secondary top menu
              -------------------->

              <!--------------------
              END - Settings Link in secondary top menu
              --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="logged-user-i">
                  <div class="avatar-w">
                    <img alt="" src="img/Phillipe.jpg">
                  </div>
                  <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                      <div class="avatar-w">
                        <img alt="" src="img/Phillipe.jpg">
                      </div>
                      <div class="logged-user-info-w">
                        <div class="logged-user-name">
                          Phillipe Cloup
                        </div>
                        <div class="logged-user-role">
                          Administrator
                        </div>
                      </div>
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                    <ul>
                      <li>
                        <a href="#"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                      </li>
                      <li>
                        <a href="#"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                      </li>
                      <li>
                        <a href="logout.php"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>
          <!--------------------
          END - Top Bar
          -------------------->
          <div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
          <div class="content-i">

          <!-- Mortgage -->

          <div id="mk-container">
            <div id="mk-waiting">
                <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <div id="mk-res" class="mk-hidden">
                <div id="res-title" class="calc-title">
                    Your monthly payment for a
                    <b><span id="res-plan-duration">30-year fixed</span></b>
                    rate loan of
                    <span id="res-loan-size">$400,000</span>
                    could be
                </div>
                <div id="res-monthly-payment">
                    $2,519.24
                </div>

                <div id="res-table-container">
                    <table id="res-table">
                        <tbody>
                            <tr class="res-table-row">
                                <td class="res-table-title">
                                    Monthly Principal & Interest
                                </td>
                                <td class="res-table-number">
                                    <span id="res-monthly-and-interest">$1,659.57</span>
                                </td>
                            </tr>
                            <tr class="res-table-row">
                                <td class="res-table-title">
                                    Property taxes
                                </td>
                                <td class="res-table-number">
                                    <span id="res-property-taxes">$693.00</span>
                                </td>
                            </tr>
                            <tr class="res-table-row">
                                <td class="res-table-title">
                                    Homeowners Insurance
                                </td>
                                <td class="res-table-number">
                                    <span id="res-insurance">$167.67</span>
                                </td>
                            </tr>
                            <tr class="res-table-total">
                                <td class="res-table-title">
                                    Total monthly payment
                                </td>
                                <td class="res-table-number">
                                    <span id="res-table-total">$2,519.24</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="res-controls">
                    <div id="res-recalculate-button" onclick="recalculate()">Recalculate</div>
                </div>
            </div>
            <div id="mk-calc" class="mk-hidden">
                <div id="loan-amount">
                    <div class="calc-title">
                        Your loan amount
                    </div>
                    <div class="calc-note">
                        Purchase price*
                    </div>
                    <div class="mk-gray-field">
                        <div class="mk-left-round mk-units mk-selected-units"><div class="mk-center">$</div></div>
                        <input id="mk-input-price" type="number" />
                    </div>
                     <div class="calc-note">
                        Down payment*
                    </div>
                    <div class="mk-gray-field">
                        <div id="units-usd" class="mk-left-round mk-units mk-selected-units" onclick="selectUnits(event, '$')"><div class="mk-center">$</div></div>
                        <div id="units-percent" class="mk-units mk-left-border" onclick="selectUnits(event, '%')"><div class="mk-center">%</div></div>
                        <input id="mk-input-down" type="number" />
                    </div>
                    <div id="mk-loan-inscription" class="calc-note mk-additional-gap mk-hidden">
                        Loan amount
                    </div>
                    <div id="mk-loan-value" class="mk-loan-amount mk-hidden">
                        <span id="loan-amount-value" /></span>
                    </div>
                </div>
                <div id="mortgage-details">
                    <div class="calc-title">
                        Mortgage details
                    </div>
                    <div class="calc-note">
                        Select your mortgage term length
                    </div>
                    <div class="mk-gray-field dropdown dropbtn" onclick="showOptions(event)">
                       <div class="mk-selected-item dropbtn">
                          <span id="selected-item">Fixed 30 Years</span>
                        </div>
                        <div class="dropbtn mk-dropdown-chevron">
                            <div class="mk-center">
                            <svg class="dropbtn" width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 2L12 12L22 2" stroke="white" stroke-width="3" stroke-linejoin="round"/>
                            </svg>
                            </div>
                        </div>
                        <div id="mk-options" class="dropdown-content">
                            <a onclick="selectItem(0)">Fixed 30 Years</a>
                            <a onclick="selectItem(1)">Fixed 20 Years</a>
                            <a onclick="selectItem(2)">Fixed 15 Years</a>
                          </div>
                    </div>
                    <div class="calc-note">
                        Property ZIP code*
                    </div>
                    <div class="mk-gray-field">
                        <input id="mk-input-zip" type="number" />
                    </div>
                    <div class="mk-blue-button mk-additional-gap" onclick="fetchPayment(event)">
                        <div class="mk-center">Calculate your monthly payment</div>
                    </div>
                </div>

                <div id="mk-title">
                    <div id="mk-arcadia-partner">
                        <img src="/trading/img/arcadia-white.svg" width="70px"/>
                        &nbsp;ARCADIA PARTNER
                    </div>
                    EVERY HOME LOAN HAS A STORY.
                    <br />
                    LET'S WRITE YOURS.
                </div>

                <div id="mk-apply-now">
                    APPLY NOW
                </div>

                <div id="mk-bottom-bar">
                    <table id="mk-table-bottom">
                        <tr>
                            <td>
                                <div class="mk-gap" />
                            </td>
                            <td>
                                <div class="mk-white-btn">Contact Us</div>
                            </td>
                            <td>
                                <div class="mk-white-btn">Information for first-time homebuyers</div>
                            </td>
                            <td>
                                <div class="mk-white-btn">Down Payment Center</div>
                            </td>
                            <td>
                                <div class="mk-gap" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mk-gap" />
                            </td>
                            <td>
                                <div class="mk-white-note">Whether you're looking to buy a new home, refinance an existing mortgage, have a question about your account or join our team, we're here to help.</div>
                            </td>
                            <td>
                                <div class="mk-white-note">Whether you’re just starting to save or you already have a house in mind, we can help you get your keys to your first home.</div>
                            </td>
                            <td>
                                <div class="mk-white-note">Search for down payment and cost savings programs that can help make buying a home more affordable.</div>
                            </td>
                            <td>
                                <div class="mk-gap" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            <div id="mk-coming-soon" class="mk-hidden">
                <table id="table-coming-soon">
                    <tr>
                        <td colspan="9" class="cell-coming-soon">
                            Coming soon
                        </td>
                    </tr>
                    <tr>
                        <td class="cell-timer-inscription-margin" />
                        <td class="cell-timer-inscription">
                            Days
                        </td>
                        <td/>
                        <td class="cell-timer-inscription">
                            Hours
                        </td>
                        <td/>
                        <td class="cell-timer-inscription">
                            Minutes
                        </td>
                        <td/>
                        <td class="cell-timer-inscription">
                            Seconds
                        </td>
                        <td class="cell-timer-inscription-margin" />
                    </tr>
                    <tr>
                        <td />
                        <td class="cell-numbers cell-timer" id="cell-days">
                            --
                        </td>
                         <td class="cell-timer">
                         :
                        </td>
                        <td class="cell-numbers cell-timer" id="cell-hrs">
                            --
                        </td>
                        <td class="cell-timer">
                           :
                        </td>
                        <td class="cell-numbers cell-timer" id="cell-mins">
                            --
                        </td>
                        <td class="cell-timer">
                            :
                            </td>
                        <td class="cell-numbers cell-timer" id="cell-secs">
                            --
                        </td>
                        <td />
                    </tr>
                </table>
            </div>
          </div>


          <!-- /Mortgage -->






              <div class="floated-colors-btn" style="display:none">
                <div class="os-toggler-w">
                  <div class="os-toggler-i">
                    <div class="os-toggler-pill"></div>
                  </div>
                </div>
                <span>Dark </span><span>Colors</span>
              </div>
              <!--------------------
              END - Color Scheme Toggler
              --------------------><!--------------------
              START - Demo Customizer
              -------------------->
              <!--------------------
              END - Demo Customizer
              --------------------><!--------------------
              START - Chat Popup Box
              -------------------->
               <!--------------------
              END - Chat Popup Box
              -------------------->
            </div>
          </div>
        </div>
      </div>
      <div class="display-type"></div>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="bower_components/dropzone/dist/dropzone.js"></script>
    <script src="bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="bower_components/bootstrap/js/dist/util.js"></script>
    <script src="bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="bower_components/bootstrap/js/dist/button.js"></script>
    <script src="bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="bower_components/bootstrap/js/dist/popover.js"></script>
    <script src="bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src="bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="js/demo_customizer.js?version=4.4.0"></script>
    <script src="js/main.js?version=4.4.0"></script>
    <script type="text/javascript">
      // Close the dropdown if the user clicks outside of it
      let currentTerm = 0;
      let currentUnits = "$";
      let currentPage = "#mk-calc";
      let countDownTimer;

      const terms = [
          {
              resMessage: "30-year fixed",
              message: "Fixed 30 Years",
              term: 360
          },
          {
              resMessage: "20-year fixed",
              message: "Fixed 20 Years",
              term: 240
          },
          {
              resMessage: "15-year fixed",
              message: "Fixed 15 Years",
              term: 180
          }
      ]

      window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
              var dropdowns = document.getElementsByClassName("dropdown-content");
              var i;
              for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                  }
              }
          }
      }

      function pad(num, size) {
          num = num.toString();
          while (num.length < size) num = "0" + num;
          return num;
      }

      function startCountDown() {
          if (countDownTimer)
              return;

          let countDownDate = new Date();
          countDownDate.setDate(countDownDate.getDate() + 2);
          countDownDate = countDownDate.getTime();

          // Update the count down every 1 second
          countDownTimer = setInterval(function() {
              // Get today's date and time
              const now = new Date().getTime();

              // Find the distance between now and the count down date
              const distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              const days = Math.floor(distance / (1000 * 60 * 60 * 24));
              const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              const seconds = Math.floor((distance % (1000 * 60)) / 1000);

              // Output the result in an element with id="demo"
              document.getElementById("cell-days").innerHTML = pad(days, 2);
              document.getElementById("cell-hrs").innerHTML = pad(hours, 2);
              document.getElementById("cell-mins").innerHTML = pad(minutes, 2);
              document.getElementById("cell-secs").innerHTML = pad(seconds, 2);

              // If the count down is over, write some text
              if (distance < 0) {
                  clearInterval(x);
                  document.getElementById("demo").innerHTML = "EXPIRED";
              }
          }, 1000);
      }


      async function fetchWithTimeout(resource, onTimeout, options = {}) {
          const { timeout = 8000 } = options;

          const controller = new AbortController();
          const id = setTimeout(() => {
              controller.abort();
              onTimeout && onTimeout();
          }, timeout);
          const response = await fetch(resource, {
              ...options,
              signal: controller.signal
          });
          clearTimeout(id);
          return response;
      }


      function checkMortgageApi() 
      {
          const href = "<?php echo $mortgage_url."/mortgage/api/index.php"; ?>";
          
          fetchWithTimeout(href, () => {
                  $("#mk-waiting").addClass("mk-hidden");
                  $("#mk-coming-soon").removeClass("mk-hidden");
                  $(currentPage).addClass("mk-hidden");
                  startCountDown();
              },
              {timeout: 5000}).then(res => {
                  $("#mk-waiting").addClass("mk-hidden");

                  if (res.status === 200) {
                      clearInterval(countDownTimer);
                      countDownTimer = undefined;
                      $("#mk-coming-soon").addClass("mk-hidden");
                      $(currentPage).removeClass("mk-hidden");
                  }
                  else {
                      $("#mk-coming-soon").removeClass("mk-hidden");
                      $("#mk-calc").addClass("mk-hidden");
                      $("#mk-res").addClass("mk-hidden");
                      startCountDown();
                  }
              })
      }

      function showOptions(e) {
          document.getElementById("mk-options").classList.toggle("show");
          e.stopImmediatePropagation();
      }

      function selectUnits(e, units) {
          currentUnits = units;
          switch (units) {
              case "%": {
                  $("#units-usd").removeClass("mk-selected-units");
                  $("#units-percent").addClass("mk-selected-units");
                  break;
              }
              case "$": {
                  $("#units-usd").addClass("mk-selected-units");
                  $("#units-percent").removeClass("mk-selected-units");
                  break;
              }
          }
      }

      function selectItem(item) {
          currentTerm = item;
          $("#selected-item").html(terms[item].message);
      }

      function fetchPayment() {
          currentPage = "#mk-res";

          $('#mk-res').addClass("mk-hidden");
          $('#mk-calc').addClass("mk-hidden");
          $('#mk-waiting').removeClass("mk-hidden");

          const price = parseFloat($('#mk-input-price').val());
          const down = parseFloat($('#mk-input-down').val());
          const term = terms[currentTerm].term;
          const zip = parseFloat($('#mk-input-zip').val());

          let downValue = down;
          if (currentUnits.trim() === "%") {
              downValue = parseFloat(down) / 100 * price;
          }

          const href = `<?php echo $mortgage_url."/mortgage/api/calculate.php"; ?>?price=${price}&down=${downValue}&term=${term}&zip=${zip}`;
          fetch(href).then(res => {
              $('#mk-waiting').addClass("mk-hidden");
              $('#mk-res').removeClass("mk-hidden");

              if (res.status === 200) {
                  res.json().then(obj => {
                      const loan = ((Math.ceil(obj.loan * 100)/100))
                          .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                      const interest = ((Math.ceil(obj.monthlyPrincipal * 100)/100))
                          .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                      const taxes = ((Math.ceil(obj.propertyTaxes * 100)/100))
                          .toLocaleString('en-US', { style: 'currency', currency: 'USD' })
                      const homeownersInsurance = ((Math.ceil(obj.homeownersInsurance * 100)/100))
                          .toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                      const monthlyTotal = ((Math.ceil(obj.monthlyTotal * 100)/100))
                          .toLocaleString('en-US', { style: 'currency', currency: 'USD' });

                      $("#res-plan-duration").text(terms[currentTerm].resMessage);
                      $("#res-loan-size").text(loan);
                      $("#res-monthly-payment").text(monthlyTotal);
                      $("#res-monthly-and-interest").text(interest);
                      $("#res-property-taxes").text(taxes);
                      $("#res-insurance").text(homeownersInsurance);
                      $("#res-table-total").text(monthlyTotal);
                  })
              }
          })
      }

      function recalculate(e) {
          currentPage = "#mk-calc";
          $('#mk-res').addClass("mk-hidden");
          $('#mk-calc').removeClass("mk-hidden");
          e.stopImmediatePropagation();
      }

      checkMortgageApi();
      setInterval(() => {
          checkMortgageApi();
      }, 3000);
    </script>
  </body>
</html>
