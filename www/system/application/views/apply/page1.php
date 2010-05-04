<div class="section">
  <h2>Basic Information</h2>
  <div class="field">
    <label for="nickname">
      Nickname
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
    <label for="dob">
      Date of Birth<span class="requiredcue">*</span></label>
    <br />
    <input id="dob" name="dob" type="text" />
    <div class="detail">
      example: April 17, 1980
    </div>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dob'] || '';
          $('#dob').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dob'] = $('#dob').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'dob'))
          {
            error_field_required('dob');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="gender">
      Gender<span class="requiredcue">*</span></label>
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'gender'))
          {
            error_field_required('gender');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="marital">
      Marital Status<span class="requiredcue">*</span></label>
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'marital'))
          {
            error_field_required('marital');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="ssn">
      Identification Number<span class="requiredcue">*</span></label>
    <br />
    <input id="ssn" name="ssn" type="text" />
    <div class="detail">
      Social Security # (US), National Insurance # (UK), etc.
    </div>
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'ssn'))
          {
            error_field_required('ssn');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="address">
      Mailing Address<span class="requiredcue">*</span></label>
    <br />
    <textarea class="small" cols="30" id="address" name="address" rows="3"></textarea>
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'address'))
          {
            error_field_required('address');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="phone">
      Telephone<span class="requiredcue">*</span></label>
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'phone'))
          {
            error_field_required('phone');
            return false;
          }
          return true;
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
      How did you hear about our ministry?<span class="requiredcue">*</span></label>
    <br />
    <select id="referrer" name="referrer">
      <option value=""></option>
      <option>
        Google or other web search engine
      </option>
      <option>
        ACTS/African Encounter
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
        Heard John Thomas speak in person
      </option>
      <option>
        Presentation at my school
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
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, 'referrer'))
          {
            error_field_required('referrer');
            return false;
          }
          return true;
        });
      //]]>
    </script>
  </div>
  <div class="field indent">
    <label for="referrer_other">
      If &quot;Other&quot;, please specify:
    </label>
    <br />
    <input id="referrer_other" name="referrer_other" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['referrer_other'] || '';
          $('#referrer_other').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['referrer_other'] = $('#referrer_other').get(0).value;
        });
      //]]>
    </script>
    
  </div>
  <div class="field">
    <label for="photo">
      Photo of you<span class="requiredcue">*</span></label>
    <br />
    <div class="nofile" id="photo-nofile">
      <span>
        <i>(None attached)</i>
      </span>
      <button id="photo-attach" type="button">
        Attach File
      </button>
    </div>
    <div class="hasfile" id="photo-hasfile">
      <a href="#" id="photo-link" target="_blank"></a>
      <button id="photo-remove" onclick="javascript:if (detach_file('photo')) {$('#photo-nofile').get(0).style.display = 'inline'; $('#photo-hasfile').get(0).style.display = 'none'; }" type="button">
        Remove File
      </button>
    </div>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function(info) {
          var val = info['photo'];
          var link = $('#photo-link').get(0);
          link.href = "<?php echo site_url('apply/download/photo') ?>"; // TODO
          if (val) {
            link.innerText = val['name'];
            $('#photo-nofile').get(0).style.display = 'none';
            $('#photo-hasfile').get(0).style.display = 'inline';
          }
          else {
            $('#photo-nofile').get(0).style.display = 'inline';
            $('#photo-hasfile').get(0).style.display = 'none';
          }
        });
        save_handlers.push(function(info) {
          // info['photo'] = value;
        });
        $('#photo-attach').get(0).onclick = function() {
          $('#fileuploaddiv').dialog({height: 150, width: 320, modal: true, title: "Upload File"});
          $('#fileuploadframe').get(0).src = "<?php echo site_url('apply/attach/photo'); ?>";
        };
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if ($('#photo-nofile').css('display') != 'none')
          {
            error_field_required('photo');
            return false;
          }
          return true;
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
      First preference of dates<span class="requiredcue">*</span></label>
    <br />
    From
    <input class="datepicker" id="dates1-from" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates1-from'] || '';
          $('#dates1-from').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates1-from'] = $('#dates1-from').get(0).value;
        });
      //]]>
    </script>
    to
    <input class="datepicker" id="dates1-to" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates1-to'] || '';
          $('#dates1-to').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates1-to'] = $('#dates1-to').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        window.date_select_handlers["dates1-from"] = function(dateText, inst) {
          var DAY = 1000*60*60*24;
          var fromDate = new Date($('#dates1-from').val());
          var millisLimit = fromDate.getTime() + DAY*30;
          var to = $('#dates1-to');
          var toDate = new Date(to.val());
          if (toDate.getTime() < millisLimit) {
            to.val('');
          }
          to.datepicker('option', 'minDate', new Date(millisLimit));
        };
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        $(function() {
          $('#dates1-from').datepicker('option', 'minDate', new Date());
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, "dates1-from") || !has_value(info, "dates1-to"))
          {
            error_field_required("dates1-from");
            return false;
          }
          else
            return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="dates2-from">
      Second preference of dates<span class="requiredcue">*</span></label>
    <br />
    From
    <input class="datepicker" id="dates2-from" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates2-from'] || '';
          $('#dates2-from').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates2-from'] = $('#dates2-from').get(0).value;
        });
      //]]>
    </script>
    to
    <input class="datepicker" id="dates2-to" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates2-to'] || '';
          $('#dates2-to').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates2-to'] = $('#dates2-to').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        window.date_select_handlers["dates2-from"] = function(dateText, inst) {
          var DAY = 1000*60*60*24;
          var fromDate = new Date($('#dates2-from').val());
          var millisLimit = fromDate.getTime() + DAY*30;
          var to = $('#dates2-to');
          var toDate = new Date(to.val());
          if (toDate.getTime() < millisLimit) {
            to.val('');
          }
          to.datepicker('option', 'minDate', new Date(millisLimit));
        };
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        $(function() {
          $('#dates2-from').datepicker('option', 'minDate', new Date());
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        validation_handlers.push(function(info) {
          if (!has_value(info, "dates2-from") || !has_value(info, "dates2-to"))
          {
            error_field_required("dates2-from");
            return false;
          }
          else
            return true;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="dates3-from">
      Third preference of dates
    </label>
    <br />
    From
    <input class="datepicker" id="dates3-from" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates3-from'] || '';
          $('#dates3-from').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates3-from'] = $('#dates3-from').get(0).value;
        });
      //]]>
    </script>
    to
    <input class="datepicker" id="dates3-to" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['dates3-to'] || '';
          $('#dates3-to').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['dates3-to'] = $('#dates3-to').get(0).value;
        });
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        window.date_select_handlers["dates3-from"] = function(dateText, inst) {
          var DAY = 1000*60*60*24;
          var fromDate = new Date($('#dates3-from').val());
          var millisLimit = fromDate.getTime() + DAY*30;
          var to = $('#dates3-to');
          var toDate = new Date(to.val());
          if (toDate.getTime() < millisLimit) {
            to.val('');
          }
          to.datepicker('option', 'minDate', new Date(millisLimit));
        };
      //]]>
    </script>
    <script type="text/javascript">
      //<![CDATA[
        $(function() {
          $('#dates3-from').datepicker('option', 'minDate', new Date());
        });
      //]]>
    </script>
  </div>
</div>
