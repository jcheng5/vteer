<div class="section">
  <h2>Comments/Concerns</h2>

  <div class="field">
    <label for="comments">
      Please note any additional comments or concerns you have.
    </label>
    <br/>
    <textarea cols="70" id="comments" name="comments" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['comments'] || '';
        $('#comments').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['comments'] = $('#comments').get(0).value;
      });
      //]]>
    </script>
  </div>
</div>
<div class="section">
  <h2>Application Commitment</h2>

  <div class="commitment">
    <p>I hereby commit myself to serving with FHBCCT (should my application be accepted) in whichever area I am
      designated by Management. I understand that I am a volunteer and that I will not be receiving any financial
      reimbursement for the work that I do while at FHBCCT. I commit myself to abide by the policies and procedures of
      the FHBCCT and to the mission, aims and objectives of the organization.</p>

    <div class="field">
      <label for="signature">
        Signature (type your full name)
      </label>
      <br/>
      <input id="signature" name="signature" type="text"/>
      <script type="text/javascript">
        //<![CDATA[
        load_handlers.push(function (info)
        {
          var val = info['signature'] || '';
          $('#signature').get(0).value = val;
        });
        save_handlers.push(function (info, form)
        {
          info['signature'] = $('#signature').get(0).value;
        });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="signaturedate">
        Today's Date
      </label>
      <br/>
      <input id="signaturedate" name="signaturedate" type="text"/>
      <script type="text/javascript">
        //<![CDATA[
        load_handlers.push(function (info)
        {
          var val = info['signaturedate'] || '';
          $('#signaturedate').get(0).value = val;
        });
        save_handlers.push(function (info, form)
        {
          info['signaturedate'] = $('#signaturedate').get(0).value;
        });
        //]]>
      </script>
    </div>
  </div>
</div>
