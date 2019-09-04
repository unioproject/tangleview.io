<div class="row flex-column">

    <div>
        <div id="toplist_wrapper">


            <div class="center net_title hide">
                <select id="netselector" class="" name="netselector">
                    <option value="mainnet" selected>Mainnet</option>
                    <option value="testnet">Devnet</option>
                    <option value="spamnet">Spamnet</option>
                </select>
            </div>


            <div id="minNumberOfTxWrapper">
                <span>Min. TX amount (toplist)</span>
                <input type="text" id="minNumberOfTxIncluded" value="1" />
                <button id="minNumberOfTxIncluded_button" type="button">Set</button>
            </div>

            <div id="txToPollWrapper">
                <span>Amount of past tx</span> <input type="text" id="txToPoll" value="15000" />
                <button id="txToPollWrapper_button" type="button">Set</button>
                <div id="loadingTX" class="hide"><img src="img/loading_spinner.gif" alt="Loading.." /></div>
            </div>

            <div id="hideZeroValue">
                <span>Hide zero value TX</span> <input type="checkbox" id="hideZero" />
            </div>

            <div id="endlessModeWrapper">
                <span>Endless mode</span> <input type="checkbox" id="endlessMode" />
            </div>

            <div id="hideSpecificAddressCheckboxWrapper" class="hide">
                <img src="img/delete.png" alt="del" />
                <!--
          <input type="checkbox" id="hideSpecificAddressCheckbox">
        -->
            </div>

            <table id="toplist"></table>

            <div id="toplist-menu">
                <div id="toplist-more" class="toplist noselect">[ show more</div>
                <div id="toplist-all" class="toplist noselect">| show all |</div>
                <div id="toplist-reset" class="toplist noselect">reset ]</div>
            </div>
        </div>

        <div id="inputs">
            <input id="address_input" type="text" name="address" value="" placeholder="Enter address to track" />
            <button id="address_button" type="button">Set</button>
            <button id="address_button_reset" type="button">Reset</button>
        </div>
        <div id="status"></div>
        <!--
      <div id="metrics_wrapper">
          <div id="metric_confrate_wrapper">
              <span>TPS: </span>
              <span id="metric_totalTPS"></span>

              <span>CTPS: </span>
              <span id="metric_totalCTPS"></span>

              <span>Confirmation rate: </span>
              <span id="metric_totalConfRate"></span>

              <span>Confirmation time: </span>
              <span id="metric_totalConfirmationTime"></span>
          </div>

      </div>
    -->

        <canvas id="canvas" width="950" height="100"></canvas>
        <div id="loading">Loading...</div>
        <div id="tooltip"></div>
    </div>



</div>