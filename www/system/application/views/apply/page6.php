<div class="section">
  <h2>Comments/Concerns</h2>
  <div class="field">
    <label for="comments">
      Please note any additional comments or concerns you have.
    </label>
    <br />
    <textarea class="large" cols="70" id="comments" name="comments" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['comments'] || '';
          $('#comments').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['comments'] = $('#comments').get(0).value;
        });
      //]]>
    </script>
    
  </div>
</div>
<div class="section">
  <h2>Application Commitment</h2>
  <div class="commitment">
    <p>I hereby commit myself to serving with FHBCCT (should my application be accepted) in whichever area I am designated by Management. I understand that I am a volunteer and that I will not be receiving any financial reimbursement for the work that I do while at FHBCCT. I commit myself to abide by the policies and procedures of the FHBCCT and to the mission, aims and objectives of the organization.</p>
    <div class="field">
      <label for="signature">
        Signature (type your full name)<span class="requiredcue">*</span></label>
      <br />
      <input id="signature" name="signature" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signature'] || '';
            $('#signature').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signature'] = $('#signature').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signature'))
            {
              error_field_required('signature');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="signaturedate">
        Today's Date<span class="requiredcue">*</span></label>
      <br />
      <input id="signaturedate" name="signaturedate" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signaturedate'] || '';
            $('#signaturedate').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signaturedate'] = $('#signaturedate').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signaturedate'))
            {
              error_field_required('signaturedate');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
  </div>
</div>
<div class="section">
  <h2>Statement of Faith</h2>
  <div class="faith">
    <p>
      I, the undersigned, a volunteer within the Fish Hoek Baptist Church Community Trust (FHBCCT), do hereby acknowledge that FHBCCT is a Christian faith-based organization and further acknowledge that the statement of faith detailed below is the basic declaration of the beliefs agreed to and held by this ministry. I agree that I will in no way, whether by word or deed, do anything contrary to or in opposition to this statement of faith while I am engaged in any activity associated with FHBCCT as a volunteer. Any violation of this agreement will result in my immediate disassociation from the FHBCCT as a volunteer.
    </p>
    <h3>Statement of Faith</h3>
    <p>
      We believe in the Triune God, the Father, the Son, and the Holy Spirit. We believe that the Bible is inspired by the Holy Spirit in all its statements.
    </p>
    <p>Therefore we confess:</p>
    <ul>
      <li>God the Father is creator and preserver of all.</li>
      <li>Jesus Christ, true man and true God, is the Son of God. He is born of the virgin Mary and He has substitutionarily shed His blood on the cross for the sins of the whole world. He is bodily resurrected and has returned into the glory of God. He sits at the right hand of God and will manifestly return.</li>
      <li>God has sent His Holy Spirit into the world, so that He might open the eyes of man in respect of sin, and of righteousness and of judgment and that He may reveal the whole divine truth to God's redeemed.</li>
      <li>Human nature is sinful. Only owing to redemption through the blood of Jesus can man by conversion and him being born again be justified before God.</li>
      <li>The redeemed will rise from the dead in glory to eternal life; those who are not redeemed will pass into everlasting destruction.</li>
      <li>All those who are born-again constitute the Church, the "Body of Christ".</li>
      <li>For the Church missionary command of Jesus is valid and binding: "Go therefore to all nations and make disciples, baptizing them in the name of the Father, and of the Son, and of the Holy Spirit: teaching them to observe all things I have command you." (Matthew 28:19-20)</li>
    </ul>
    <div class="field">
      <label for="signature2">
        Signature (type your full name)<span class="requiredcue">*</span></label>
      <br />
      <input id="signature2" name="signature2" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signature2'] || '';
            $('#signature2').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signature2'] = $('#signature2').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signature2'))
            {
              error_field_required('signature2');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="signaturedate2">
        Today's Date<span class="requiredcue">*</span></label>
      <br />
      <input id="signaturedate2" name="signaturedate2" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signaturedate2'] || '';
            $('#signaturedate2').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signaturedate2'] = $('#signaturedate2').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signaturedate2'))
            {
              error_field_required('signaturedate2');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
  </div>
</div>
<div class="section">
  <h2>Volunteer Worker Indemnity</h2>
  <div class="indemnity">
    <p>
      I, the undersigned, a volunteer within the Fish Hoek Baptist Church Community Trust, do hereby acknowledge and confirm that:
    </p>
    <ol>
      <li>
        I, my heirs, executors or assigns, indemnify and hold harmless the Fish Hoek Baptist Church Community Trust (FHBCCT) which trades as Living Hope Community Centre, Living Way, Living Grace, et.al., and its trustees, officers, employees, and partners against any injury, illness, harm, loss, consequential loss, damage or damages of whatsoever nature that I may sustain or suffer as a result of my decision to do volunteer work within FHBCCT as set out above, and arising out of any cause whatsoever nature, including but not limited to negligence, and howsoever arising.
      </li>
      <li>If voluntary worker is under 21 (twenty-one) years of age, this Indemnity is to be signed by the individual's natural legal guardian.</li>
    </ol>
    <div class="field">
      <label for="signature3">
        Signature (volunteer or parent/guardian, type full name)<span class="requiredcue">*</span></label>
      <br />
      <input id="signature3" name="signature3" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signature3'] || '';
            $('#signature3').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signature3'] = $('#signature3').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signature3'))
            {
              error_field_required('signature3');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="signaturedate3">
        Today's Date<span class="requiredcue">*</span></label>
      <br />
      <input id="signaturedate3" name="signaturedate3" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['signaturedate3'] || '';
            $('#signaturedate3').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['signaturedate3'] = $('#signaturedate3').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'signaturedate3'))
            {
              error_field_required('signaturedate3');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="indemnitywitness1">
        Signature of Witness 1<span class="requiredcue">*</span></label>
      <br />
      <input id="indemnitywitness1" name="indemnitywitness1" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['indemnitywitness1'] || '';
            $('#indemnitywitness1').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['indemnitywitness1'] = $('#indemnitywitness1').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'indemnitywitness1'))
            {
              error_field_required('indemnitywitness1');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
    <div class="field">
      <label for="indemnitywitness2">
        Signature of Witness 2<span class="requiredcue">*</span></label>
      <br />
      <input id="indemnitywitness2" name="indemnitywitness2" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['indemnitywitness2'] || '';
            $('#indemnitywitness2').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['indemnitywitness2'] = $('#indemnitywitness2').get(0).value;
          });
        //]]>
      </script>
      <script type="text/javascript">
        //<![CDATA[
          validation_handlers.push(function(info) {
            if (!has_value(info, 'indemnitywitness2'))
            {
              error_field_required('indemnitywitness2');
              return false;
            }
            return true;
          });
        //]]>
      </script>
    </div>
  </div>
</div>
