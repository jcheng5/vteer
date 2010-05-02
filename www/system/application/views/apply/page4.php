<div class="section">
  <h2>Biographical Information</h2>
  <div class="field">
    <label for="conversion">
      How and when did you become a Christian?<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="conversion" name="conversion" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['conversion'] || '';
          $('#conversion').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['conversion'] = $('#conversion').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'conversion'))
          {
            error_field_required('conversion');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="lifechange">
      Describe how your life has changed.<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="lifechange" name="lifechange" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['lifechange'] || '';
          $('#lifechange').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['lifechange'] = $('#lifechange').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'lifechange'))
          {
            error_field_required('lifechange');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="history">
      Please write a brief overview of your personal history (where you grew up, childhood experiences, and how these affect your life now).<span class="requiredcue">*</span></label>
    <br />
    <textarea class="large" cols="70" id="history" name="history" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['history'] || '';
          $('#history').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['history'] = $('#history').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'history'))
          {
            error_field_required('history');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="strength">
      What would others say is your strongest quality, and why?<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="strength" name="strength" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['strength'] || '';
          $('#strength').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['strength'] = $('#strength').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'strength'))
          {
            error_field_required('strength');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="weakness">
      What would others say is your weakest quality, and why?<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="weakness" name="weakness" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['weakness'] || '';
          $('#weakness').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['weakness'] = $('#weakness').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'weakness'))
          {
            error_field_required('weakness');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="submission">
      When do you find it difficult to submit to others?<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="submission" name="submission" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['submission'] || '';
          $('#submission').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['submission'] = $('#submission').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'submission'))
          {
            error_field_required('submission');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="churchhistory">
      Describe your personal church history (various ones you've attended, why you switched, etc.).<span class="requiredcue">*</span></label>
    <br />
    <textarea class="large" cols="70" id="churchhistory" name="churchhistory" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['churchhistory'] || '';
          $('#churchhistory').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['churchhistory'] = $('#churchhistory').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'churchhistory'))
          {
            error_field_required('churchhistory');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="faith">
      Describe your personal &quot;statement of faith.&quot; What do you believe?<span class="requiredcue">*</span></label>
    <br />
    <textarea class="large" cols="70" id="faith" name="faith" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['faith'] || '';
          $('#faith').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['faith'] = $('#faith').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'faith'))
          {
            error_field_required('faith');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="southafrica">
      Do you feel specifically called to South Africa? Explain.<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="southafrica" name="southafrica" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['southafrica'] || '';
          $('#southafrica').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['southafrica'] = $('#southafrica').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'southafrica'))
          {
            error_field_required('southafrica');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="calling">
      Explain how and why you feel God is calling you to be part of Living Hope. Also include what area of ministry you would specifically like to get involved in and how you see yourself fitting in.<span class="requiredcue">*</span></label>
    <br />
    <textarea class="large" cols="70" id="calling" name="calling" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['calling'] || '';
          $('#calling').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['calling'] = $('#calling').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'calling'))
          {
            error_field_required('calling');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="gifts">
      Please check all areas you consider yourself gifted in<span class="requiredcue">*</span></label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        save_handlers.push(function (info) {
          info['gifts'] = [];
        });
      //]]>
    </script>
    <input id="gifts0" name="gifts" type="checkbox" value="Sports" />
    <label for="gifts0">
      Sports
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts0').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Sports') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts0').get(0).checked)
            info['gifts'].push('Sports')
        });
      //]]>
    </script>
    <input id="gifts1" name="gifts" type="checkbox" value="Administration" />
    <label for="gifts1">
      Administration
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts1').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Administration') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts1').get(0).checked)
            info['gifts'].push('Administration')
        });
      //]]>
    </script>
    <input id="gifts2" name="gifts" type="checkbox" value="Children" />
    <label for="gifts2">
      Children
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts2').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Children') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts2').get(0).checked)
            info['gifts'].push('Children')
        });
      //]]>
    </script>
    <input id="gifts3" name="gifts" type="checkbox" value="Healthcare" />
    <label for="gifts3">
      Healthcare
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts3').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Healthcare') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts3').get(0).checked)
            info['gifts'].push('Healthcare')
        });
      //]]>
    </script>
    <input id="gifts4" name="gifts" type="checkbox" value="Photography" />
    <label for="gifts4">
      Photography
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts4').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Photography') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts4').get(0).checked)
            info['gifts'].push('Photography')
        });
      //]]>
    </script>
    <input id="gifts5" name="gifts" type="checkbox" value="Landscaping" />
    <label for="gifts5">
      Landscaping
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts5').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Landscaping') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts5').get(0).checked)
            info['gifts'].push('Landscaping')
        });
      //]]>
    </script>
    <input id="gifts6" name="gifts" type="checkbox" value="Construction or Maintenance" />
    <label for="gifts6">
      Construction or Maintenance
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts6').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Construction or Maintenance') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts6').get(0).checked)
            info['gifts'].push('Construction or Maintenance')
        });
      //]]>
    </script>
    <input id="gifts7" name="gifts" type="checkbox" value="Music" />
    <label for="gifts7">
      Music
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts7').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Music') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts7').get(0).checked)
            info['gifts'].push('Music')
        });
      //]]>
    </script>
    <input id="gifts8" name="gifts" type="checkbox" value="Schoolteacher" />
    <label for="gifts8">
      Schoolteacher
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts8').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Schoolteacher') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts8').get(0).checked)
            info['gifts'].push('Schoolteacher')
        });
      //]]>
    </script>
    <input id="gifts9" name="gifts" type="checkbox" value="Prayer" />
    <label for="gifts9">
      Prayer
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts9').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Prayer') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts9').get(0).checked)
            info['gifts'].push('Prayer')
        });
      //]]>
    </script>
    <input id="gifts10" name="gifts" type="checkbox" value="Counseling" />
    <label for="gifts10">
      Counseling
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts10').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Counseling') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts10').get(0).checked)
            info['gifts'].push('Counseling')
        });
      //]]>
    </script>
    <input id="gifts11" name="gifts" type="checkbox" value="Reading" />
    <label for="gifts11">
      Reading
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts11').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Reading') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts11').get(0).checked)
            info['gifts'].push('Reading')
        });
      //]]>
    </script>
    <input id="gifts12" name="gifts" type="checkbox" value="Computer" />
    <label for="gifts12">
      Computer
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts12').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Computer') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts12').get(0).checked)
            info['gifts'].push('Computer')
        });
      //]]>
    </script>
    <input id="gifts13" name="gifts" type="checkbox" value="Journalism" />
    <label for="gifts13">
      Journalism
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts13').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Journalism') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts13').get(0).checked)
            info['gifts'].push('Journalism')
        });
      //]]>
    </script>
    <input id="gifts14" name="gifts" type="checkbox" value="Sewing" />
    <label for="gifts14">
      Sewing
    </label>
    <br />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['gifts'];
          $('#gifts14').get(0).checked = (typeof(val) != 'undefined')
                                           && (val.indexOf('Sewing') >= 0);
        });
        save_handlers.push(function (info) {
          var values = [];
          if ($('#gifts14').get(0).checked)
            info['gifts'].push('Sewing')
        });
      //]]>
    </script>
    <div class="field">
      <label for="gifts-other">
        Other
      </label>
      <input id="gifts-other" name="gifts-other" type="text" />
      <script type="text/javascript">
        //<![CDATA[
          load_handlers.push(function (info) {
            var val = info['gifts-other'] || '';
            $('#gifts-other').get(0).value = val;
          });
          save_handlers.push(function (info, form) {
            info['gifts-other'] = $('#gifts-other').get(0).value;
          });
        //]]>
      </script>
      
    </div>
    <script type="text/javascript">
      //<![CDATA[
        save_handlers.push(function (info) {
          if (has_value(info, 'gifts-other'))
            info['gifts'].push(info['gifts-other']);
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'gifts'))
          {
            error_field_required('gifts');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="leadgifts">
      Of the areas you checked, please note which ones you would consider yourself strong enough to lead a team in projects within this area.<span class="requiredcue">*</span></label>
    <br />
    <textarea class="small" cols="30" id="leadgifts" name="leadgifts" rows="3"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['leadgifts'] || '';
          $('#leadgifts').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['leadgifts'] = $('#leadgifts').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'leadgifts'))
          {
            error_field_required('leadgifts');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
</div>
<div class="section">
  <h2>Volunteer Positions</h2>
  <div class="field">
    <label for="positions">
      Please list your top three choices for volunteer positions.<span class="requiredcue">*</span></label>
    <br />
    <textarea class="medium" cols="40" id="positions" name="positions" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['positions'] || '';
          $('#positions').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['positions'] = $('#positions').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'positions'))
          {
            error_field_required('positions');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
</div>
