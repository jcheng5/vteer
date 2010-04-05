<div class="section">
  <h2>Education</h2>
  <div class="field">
    <label for="educationlevel">
      Highest level of education completed
    </label>
    <br />
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
        load_handlers.push(function (info, form) {
          var val = info['educationlevel'];
          var select = form.elements['educationlevel'];
          for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].value == val) {
              select.selectedIndex = i;
              break;
            }
          }
        });
        save_handlers.push(function (info, form) {
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
      List any post-high school institutions attended, as well as the dates attended, degrees attained, and major/minor fields of study.
    </label>
    <br />
    <textarea cols="40" id="schools" name="schools" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['schools'] || '';
          $('#schools').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
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
    <br />
    <input id="occupation" name="occupation" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['occupation'] || '';
          $('#occupation').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['occupation'] = $('#occupation').get(0).value;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="employer">
      Company/Organization
    </label>
    <br />
    <input id="employer" name="employer" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['employer'] || '';
          $('#employer').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['employer'] = $('#employer').get(0).value;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="datehired">
      Date Hired
    </label>
    <br />
    <select id="datehired_month" name="datehired_month">
      <option>[Month]</option>
      <option>January</option>
      <option>February</option>
      <option>March</option>
      <option>April</option>
      <option>May</option>
      <option>June</option>
      <option>July</option>
      <option>August</option>
      <option>September</option>
      <option>October</option>
      <option>November</option>
      <option>December</option>
    </select>
    <select id="datehired_day" name="datehired_day">
      <option>[Day]</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
      <option>13</option>
      <option>14</option>
      <option>15</option>
      <option>16</option>
      <option>17</option>
      <option>18</option>
      <option>19</option>
      <option>20</option>
      <option>21</option>
      <option>22</option>
      <option>23</option>
      <option>24</option>
      <option>25</option>
      <option>26</option>
      <option>27</option>
      <option>28</option>
      <option>29</option>
      <option>30</option>
      <option>31</option>
    </select>
    <select id="datehired_year" name="datehired_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2009</option>
      <option>2008</option>
      <option>2007</option>
      <option>2006</option>
      <option>2005</option>
      <option>2004</option>
      <option>2003</option>
      <option>2002</option>
      <option>2001</option>
      <option>2000</option>
      <option>1999</option>
      <option>1998</option>
      <option>1997</option>
      <option>1996</option>
      <option>1995</option>
      <option>1994</option>
      <option>1993</option>
      <option>1992</option>
      <option>1991</option>
      <option>1990</option>
      <option>1989</option>
      <option>1988</option>
      <option>1987</option>
      <option>1986</option>
      <option>1985</option>
      <option>1984</option>
      <option>1983</option>
      <option>1982</option>
      <option>1981</option>
      <option>1980</option>
      <option>1979</option>
      <option>1978</option>
      <option>1977</option>
      <option>1976</option>
      <option>1975</option>
      <option>1974</option>
      <option>1973</option>
      <option>1972</option>
      <option>1971</option>
      <option>1970</option>
      <option>1969</option>
      <option>1968</option>
      <option>1967</option>
      <option>1966</option>
      <option>1965</option>
      <option>1964</option>
      <option>1963</option>
      <option>1962</option>
      <option>1961</option>
      <option>1960</option>
      <option>1959</option>
      <option>1958</option>
      <option>1957</option>
      <option>1956</option>
      <option>1955</option>
      <option>1954</option>
      <option>1953</option>
      <option>1952</option>
      <option>1951</option>
      <option>1950</option>
      <option>1949</option>
      <option>1948</option>
      <option>1947</option>
      <option>1946</option>
      <option>1945</option>
      <option>1944</option>
      <option>1943</option>
      <option>1942</option>
      <option>1941</option>
      <option>1940</option>
      <option>1939</option>
      <option>1938</option>
      <option>1937</option>
      <option>1936</option>
      <option>1935</option>
      <option>1934</option>
      <option>1933</option>
      <option>1932</option>
      <option>1931</option>
      <option>1930</option>
      <option>1929</option>
      <option>1928</option>
      <option>1927</option>
      <option>1926</option>
      <option>1925</option>
      <option>1924</option>
      <option>1923</option>
      <option>1922</option>
      <option>1921</option>
      <option>1920</option>
      <option>1919</option>
      <option>1918</option>
      <option>1917</option>
      <option>1916</option>
      <option>1915</option>
      <option>1914</option>
      <option>1913</option>
      <option>1912</option>
      <option>1911</option>
      <option>1910</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#datehired_year').get(0);
          var month = $('#datehired_month').get(0);
          var day = $('#datehired_day').get(0);
          
          var value = info['datehired'];
          var regexp = /^([a-z]+) ([0-9]+), ([0-9]+)$/i
        
          if (!value || !value.match(regexp)) {
            year.selectedIndex = 0;
            month.selectedIndex = 0;
            day.selectedIndex = 0;
          }
          else {
            var result = regexp.exec(value);
            var monthStr = result[1];
            var dayStr = result[2];
            var yearStr = result[3];
            
            function restore(select, val) {
              for (var i = 0; i < select.options.length; i++)
                if (select.options[i].value == val) {
                  select.selectedIndex = i;
                  break;
                }
            }
            
            restore(year, yearStr);
            restore(month, monthStr);
            restore(day, dayStr);
          }
          
        });
        save_handlers.push(function (info) {
          var year = $('#datehired_year').get(0);
          var month = $('#datehired_month').get(0);
          var day = $('#datehired_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['datehired'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['datehired'] == null;
          }
          else {
            info['datehired'] = month.value + " " + day.value + ", " + year.value;
          }
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="employercontact">
      Contact &amp; Phone
    </label>
    <br />
    <input id="employercontact" name="employercontact" type="text" />
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['employercontact'] || '';
          $('#employercontact').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['employercontact'] = $('#employercontact').get(0).value;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="career">
      Briefly describe your career history and tell us how this relates to your ministry.
    </label>
    <br />
    <textarea cols="40" id="career" name="career" rows="5"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['career'] || '';
          $('#career').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
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
    <br />
    <input id="crosscultural-yes" name="crosscultural" type="radio" value="Yes" />
    <label class="option" for="crosscultural-yes">
      Yes
    </label>
    <input id="crosscultural-no" name="crosscultural" type="radio" value="No" />
    <label class="option" for="crosscultural-no">
      No
    </label>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function(info) {
          var val = info['crosscultural'];
          $('#crosscultural-yes').get(0).checked = (val === 'Yes');
          $('#crosscultural-no').get(0).checked = (val === 'No');
        });
        save_handlers.push(function(info) {
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
      List the countries you have been to, including the dates, the organization(s) you traveled with, the types of ministry you were involved in, and any leadership positions you held.
    </label>
    <br />
    <textarea cols="70" id="travel" name="travel" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['travel'] || '';
          $('#travel').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['travel'] = $('#travel').get(0).value;
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="ministry">
      List any other formal ministry experience you have had and leadership positions you have held. For each, list the organization/church, responsibilities, and dates.
    </label>
    <br />
    <textarea cols="70" id="ministry" name="ministry" rows="12"></textarea>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var val = info['ministry'] || '';
          $('#ministry').get(0).value = val;
        });
        save_handlers.push(function (info, form) {
          info['ministry'] = $('#ministry').get(0).value;
        });
      //]]>
    </script>
  </div>
</div>
