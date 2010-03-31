<div class="section">
<h2>Basic Information</h2>
<div class="field">
  <label for="dob">
    Date of birth
  </label>
  <br />
  <input id="dob" name="dob" />
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['dob'] || '';
      $('#dob').get(0).value = val;
    });
    save_handlers.push(function (info) {
      info['dob'] = $('#dob').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="gender">
    Gender
  </label>
  <br />
  <input id="gender0" name="gender" type="radio" value="Male" />
  <label class="option" for="gender0">
    Male
  </label>
  <input id="gender1" name="gender" type="radio" value="Female" />
  <label class="option" for="gender1">
    Female
  </label>
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info, form) {
      var val = info['gender'];
      var options = form.elements['gender'];
      for (var i = 0; i < options.length; i++) {
        if (options[i].value == val) {
          options[i].checked = true;
          break;
        }
      }
    });
    save_handlers.push(function (info, form) {
      var options = form.elements['gender'];
      var value = '';
      for (var i = 0; i < options.length; i++) {
        if (options[i].checked) {
          value = options[i].value;
          break;
        }
      }
      info['gender'] = value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="marital">
    Marital Status
  </label>
  <br />
  <input id="marital0" name="marital" type="radio" value="Single" />
  <label class="option" for="marital0">
    Single
  </label>
  <input id="marital1" name="marital" type="radio" value="Married" />
  <label class="option" for="marital1">
    Married
  </label>
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info, form) {
      var val = info['marital'];
      var options = form.elements['marital'];
      for (var i = 0; i < options.length; i++) {
        if (options[i].value == val) {
          options[i].checked = true;
          break;
        }
      }
    });
    save_handlers.push(function (info, form) {
      var options = form.elements['marital'];
      var value = '';
      for (var i = 0; i < options.length; i++) {
        if (options[i].checked) {
          value = options[i].value;
          break;
        }
      }
      info['marital'] = value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="ssn">
    Social Security # or ID #
  </label>
  <br />
  <input id="ssn" name="ssn" type="text" />
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['ssn'] || '';
      $('#ssn').get(0).value = val;
    });
    save_handlers.push(function (info, form) {
      info['ssn'] = $('#ssn').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="nickname">
    What you like to be called (name you go by)
  </label>
  <br />
  <input id="nickname" name="nickname" type="text" />
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['nickname'] || '';
      $('#nickname').get(0).value = val;
    });
    save_handlers.push(function (info, form) {
      info['nickname'] = $('#nickname').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="address">
    Mailing Address
  </label>
  <br />
  <textarea cols="30" id="address" name="address" rows="3"></textarea>
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['address'] || '';
      $('#address').get(0).value = val;
    });
    save_handlers.push(function (info, form) {
      info['address'] = $('#address').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="phone">
    Telephone
  </label>
  <br />
  <input id="phone" name="phone" type="text" />
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['phone'] || '';
      $('#phone').get(0).value = val;
    });
    save_handlers.push(function (info, form) {
      info['phone'] = $('#phone').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="fax">
    Fax
  </label>
  <br />
  <input id="fax" name="fax" type="text" />
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info) {
      var val = info['fax'] || '';
      $('#fax').get(0).value = val;
    });
    save_handlers.push(function (info, form) {
      info['fax'] = $('#fax').get(0).value;
    });
    //]]>
  </script>
</div>
<div class="field">
  <label for="referrer">
    How did you hear about our ministry?
  </label>
  <br />
  <select id="referrer" name="referrer">
    <option value=""></option>
    <option>
      ACTS
    </option>
    <option>
      African Encounter
    </option>
    <option>
      Living Hope
    </option>
    <option>
      Friend
    </option>
    <option>
      I am a former volunteer
    </option>
    <option>
      Through my local church
    </option>
    <option>
      Internet Living Hope/Way/Grace
    </option>
    <option>
      Internet ACTS
    </option>
    <option>
      Internet African Encounter
    </option>
    <option>
      Other
    </option>
  </select>
  <script type="text/javascript">
    //<![CDATA[
    load_handlers.push(function (info, form) {
      var val = info['referrer'];
      var select = form.elements['referrer'];
      for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value == val) {
          select.selectedIndex = i;
          break;
        }
      }
    });
    save_handlers.push(function (info, form) {
      var select = form.elements['referrer'];
      if (select.selectedIndex >= 0)
        info['referrer'] = select.options[select.selectedIndex].value;
      else
        info['referrer'] = '';
    });
    //]]>
  </script>
</div>
</div>
<div class="section">
  <h2>Preferred Dates</h2>
  <h4>Please indicate when you would like to visit. Since there are many factors involved in scheduling volunteers, please indicate your first, second, and third preferences for working with Living Hope. We have a minimum service time commitment of 30 days.</h4>
  <div class="field">
    <label for="dates1-from">
      First preference of dates
    </label>
    <br />
    <input id="dates1-from" name="dates1-from" />
    <input id="dates1-to" name="dates1-to" />
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info) {
        var val = info['dates1'] || [null, null];
        $('#dates1-from').get(0).value = val[0] || '';
        $('#dates1-to').get(0).value = val[1] || '';
      });
      save_handlers.push(function (info) {
        info['dates1'] = [$('#dates1-from').get(0).value, $('#dates1-to').get(0).value];
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="dates2-from">
      Second preference of dates
    </label>
    <br />
    <input id="dates2-from" name="dates2-from" />
    <input id="dates2-to" name="dates2-to" />
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info) {
        var val = info['dates2'] || [null, null];
        $('#dates2-from').get(0).value = val[0] || '';
        $('#dates2-to').get(0).value = val[1] || '';
      });
      save_handlers.push(function (info) {
        info['dates2'] = [$('#dates2-from').get(0).value, $('#dates2-to').get(0).value];
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="dates3-from">
      Third preference of dates
    </label>
    <br />
    <input id="dates3-from" name="dates3-from" />
    <input id="dates3-to" name="dates3-to" />
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info) {
        var val = info['dates3'] || [null, null];
        $('#dates3-from').get(0).value = val[0] || '';
        $('#dates3-to').get(0).value = val[1] || '';
      });
      save_handlers.push(function (info) {
        info['dates3'] = [$('#dates3-from').get(0).value, $('#dates3-to').get(0).value];
      });
      //]]>
    </script>
  </div>
</div>
<div class="section">
  <h2>Transport</h2>
  <h4>Please note that there is no public transportation in our area.</h4>
  <div class="field">
    <label for="transport">
      Will you have your own transportation? (Do you plan to rent or purchase a car?)
    </label>
    <br />
    <input id="transport-yes" name="transport" type="radio" value="Yes" />
    <label class="option" for="transport-yes">
      Yes
    </label>
    <input id="transport-no" name="transport" type="radio" value="No" />
    <label class="option" for="transport-no">
      No
    </label>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function(info) {
        var val = info['transport'];
        $('#transport-yes').get(0).checked = (val === 'Yes');
        $('#transport-no').get(0).checked = (val === 'No');
      });
      save_handlers.push(function(info) {
        var value;
        if ($('#transport-yes').get(0).checked)
          value = 'Yes';
        else if ($('#transport-no').get(0).checked)
          value = 'No';
        else
          value = '';

        info['transport'] = value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="license">
      Do you have an international driver's license?
    </label>
    <br />
    <input id="license-yes" name="license" type="radio" value="Yes" />
    <label class="option" for="license-yes">
      Yes
    </label>
    <input id="license-no" name="license" type="radio" value="No" />
    <label class="option" for="license-no">
      No
    </label>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function(info) {
        var val = info['license'];
        $('#license-yes').get(0).checked = (val === 'Yes');
        $('#license-no').get(0).checked = (val === 'No');
      });
      save_handlers.push(function(info) {
        var value;
        if ($('#license-yes').get(0).checked)
          value = 'Yes';
        else if ($('#license-no').get(0).checked)
          value = 'No';
        else
          value = '';

        info['license'] = value;
      });
      //]]>
    </script>
  </div>
</div>