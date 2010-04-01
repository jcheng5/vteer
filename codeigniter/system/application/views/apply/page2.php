<div class="section">
  <h2>Education</h2>

  <div class="field">
    <label for="educationlevel">
      Highest level of education completed
    </label>
    <br/>
    <select id="educationlevel" name="educationlevel">
      <option value=""></option>
      <option>
        Some high school
      </option>
      <option>
        High school diploma or equivalent
      </option>
      <option>
        Some college
      </option>
      <option>
        Associate Degree
      </option>
      <option>
        Bachelor Degree
      </option>
      <option>
        Advanced Degree
      </option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info, form)
      {
        var val = info['educationlevel'];
        var select = form.elements['educationlevel'];
        for (var i = 0; i < select.options.length; i++)
        {
          if (select.options[i].value == val)
          {
            select.selectedIndex = i;
            break;
          }
        }
      });
      save_handlers.push(function (info, form)
      {
        var select = form.elements['educationlevel'];
        if (select.selectedIndex >= 0)
          info['educationlevel'] = select.options[select.selectedIndex].value;
        else
          info['educationlevel'] = '';
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="schools">
      List any post-high school institutions attended, as well as the dates attended, degrees attained, and major/minor
      fields of study.
    </label>
    <br/>
    <textarea cols="40" id="schools" name="schools" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['schools'] || '';
        $('#schools').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['schools'] = $('#schools').get(0).value;
      });
      //]]>
    </script>
  </div>
</div>
<div class="section">
  <h2>Career History</h2>

  <div class="field">
    <label for="occupation">
      Present Occupation
    </label>
    <br/>
    <input id="occupation" name="occupation" type="text"/>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['occupation'] || '';
        $('#occupation').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['occupation'] = $('#occupation').get(0).value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="employer">
      Company/Organization
    </label>
    <br/>
    <input id="employer" name="employer" type="text"/>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['employer'] || '';
        $('#employer').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['employer'] = $('#employer').get(0).value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="datehired">
      Date Hired
    </label>
    <br/>
    <input id="datehired" name="datehired"/>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['datehired'] || '';
        $('#datehired').get(0).value = val;
      });
      save_handlers.push(function (info)
      {
        info['datehired'] = $('#datehired').get(0).value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="employercontact">
      Contact &amp; Phone
    </label>
    <br/>
    <input id="employercontact" name="employercontact" type="text"/>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['employercontact'] || '';
        $('#employercontact').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['employercontact'] = $('#employercontact').get(0).value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="career">
      Briefly describe your career history and tell us how this relates to your ministry.
    </label>
    <br/>
    <textarea cols="40" id="career" name="career" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['career'] || '';
        $('#career').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['career'] = $('#career').get(0).value;
      });
      //]]>
    </script>
  </div>
</div>
<div class="section">
  <h2>Ministry</h2>

  <div class="field">
    <label for="crosscultural">
      Do you have experience in cross-cultural ministry?
    </label>
    <br/>
    <input id="crosscultural-yes" name="crosscultural" type="radio" value="Yes"/>
    <label class="option" for="crosscultural-yes">
      Yes
    </label>
    <input id="crosscultural-no" name="crosscultural" type="radio" value="No"/>
    <label class="option" for="crosscultural-no">
      No
    </label>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function(info)
      {
        var val = info['crosscultural'];
        $('#crosscultural-yes').get(0).checked = (val === 'Yes');
        $('#crosscultural-no').get(0).checked = (val === 'No');
      });
      save_handlers.push(function(info)
      {
        var value;
        if ($('#crosscultural-yes').get(0).checked)
          value = 'Yes';
        else if ($('#crosscultural-no').get(0).checked)
          value = 'No';
        else
          value = '';

        info['crosscultural'] = value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="travel">
      List the countries you have been to, including the dates, the organization(s) you traveled with, the types of
      ministry you were involved in, and any leadership positions you held.
    </label>
    <br/>
    <textarea cols="70" id="travel" name="travel" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['travel'] || '';
        $('#travel').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['travel'] = $('#travel').get(0).value;
      });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="ministry">
      List any other formal ministry experience you have had and leadership positions you have held. For each, list the
      organization/church, responsibilities, and dates.
    </label>
    <br/>
    <textarea cols="70" id="ministry" name="ministry" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
      load_handlers.push(function (info)
      {
        var val = info['ministry'] || '';
        $('#ministry').get(0).value = val;
      });
      save_handlers.push(function (info, form)
      {
        info['ministry'] = $('#ministry').get(0).value;
      });
      //]]>
    </script>
  </div>
</div>
