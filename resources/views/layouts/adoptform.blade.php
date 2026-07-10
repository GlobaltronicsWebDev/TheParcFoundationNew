<!-- Personal Info Form -->
          <div>
            <h3 class="formtitle">Your Information</h3>
            <form action="{{ route('adoptions.store') }}" method="POST" class="personalinfo">
               @csrf
            <label for="fname">First name</label>
              <input type="text" id="fname" name="fname" />

              <label for="lname">Last name</label>
              <input type="text" id="lname" name="lname" />

              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" />

              <label for="country">Country</label>
              <input type="text" id="country" name="country" />

              <label for="street">Street Address</label>
              <input type="text" id="street" name="street" />

              <label for="city">City</label>
              <input type="text" id="city" name="city" />

              <label for="postal">Postal</label>
              <input type="text" id="postal" name="postal" />

              <p class="p1form">BE PART OF OUR COMMUNITY</p>
              <p class="p2from">
                Stay updated on how you can help empower youth through music. From inspiring stories to events and ways to give - we'll keep you in the loop. You can unsubscribe at any time.
              </p>

            <!-- Radio Buttons -->
              <b><p>I would like to get email updates:</p></b>
              <fieldset class="radio-group">
                <input class="form-check-input" type="radio" name="emailUpdates" id="emailYes" value="yes" />
                <label class="form-check-label" for="emailYes">Yes</label>

                <input class="form-check-input" type="radio" name="emailUpdates" id="emailNo" value="no" />
                <label class="form-check-label" for="emailNo">No</label>
              </fieldset>

              <b><p>I would like to get PARC text messages:</p></b>
              <fieldset class="radio-group">
                <input class="form-check-input" type="radio" name="textUpdates" id="textYes" value="yes" />
                <label class="form-check-label" for="textYes">Yes</label>

                <input class="form-check-input" type="radio" name="textUpdates" id="textNo" value="no" />
                <label class="form-check-label" for="textNo">No</label>
              </fieldset>

          <!-- Note -->
          <div class="note2">
            <p class="p3">
            We will keep your information safe and secure. Please see our<b class="privacy"> Privacy Policy </b>for details of how we use your information.            </p>
          </div>

          <!--Payment Method-->
          <h3 class="formtitle">Payment Method</h3>

          <!-- <div class="centerpay-btn pay-btn">
            <a href="#" class="btnm7"><img src="{{ asset('assets/icons/visa.png') }}" alt="Visa" class="visaicon" /></a>
            <a href="#" class="btnm8"><img src="{{ asset('assets/icons/paypal.png') }}" alt="paypal" class="paypalicon" /></a>
          </div> -->

          <a href="#" class="btnm9" id="btn-bank">Bank Account</a>
          
          <div class="notebank" id="notebank" style="display: none; background-color: #eae8e8; padding: 20px; margin-top: 15px; border-radius: 8px; text-align: center;">
            <p style="font-weight: bold; color: #f78f1e; margin-bottom: 15px;">Scan to Donate</p>
            <div style="display: flex; justify-content: center; align-items: center;">
              <img src="{{ asset('assets/image/qr_code.png') }}" alt="PARC Foundation QR Code" style="width: 260px; height: auto; border: 1px solid #ccc; border-radius: 8px; background: #fff; padding: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" />
            </div>
            <p style="margin-top: 15px; font-size: 14px; color: #555;">After scanning please screenshot your reciept and attachment it on form </p>
          </div>

          <script>
            document.addEventListener("DOMContentLoaded", function () {
              const btnBank = document.getElementById("btn-bank");
              const noteBank = document.getElementById("notebank");

              if(btnBank && noteBank) {
                btnBank.addEventListener("click", function (e) {
                  e.preventDefault();
                  if (noteBank.style.display === "none") {
                    noteBank.style.display = "block";
                  } else {
                    noteBank.style.display = "none";
                  }
                });
              }
            });
          </script>

              <!-- <label for="card_number">Card Number</label>
              <input type="text" id="card_number" name="card_number" /> -->
<!-- 
              <div class="bankcard">
                <label for="exp_month">Expiration Date</label>
                <input type="text" id="exp_month" name="exp_month" placeholder="MM" />
                <span>/</span>
                <input type="text" id="exp_year" name="exp_year" placeholder="YY" />
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" />
              </div> -->

            <div class="last">
              <input type="checkbox" id="checkparc" name="checkparc" value="">
              <label for="checkparc">I want PARC to receive 100% of my donation. I'll cover processing fees ($0.30).</label><br>
            </div>
              <input type="submit" value="DONATE" />

              
            </form>
          </div>