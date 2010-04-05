<div class="section">
  <h2>Basic Information</h2>
  <div class="field">
    <label for="dob">
      Date of birth
    </label>
    <br />
    <select id="dob_month" name="dob_month">
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
    <select id="dob_day" name="dob_day">
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
    <select id="dob_year" name="dob_year">
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
          var year = $('#dob_year').get(0);
          var month = $('#dob_month').get(0);
          var day = $('#dob_day').get(0);
          
          var value = info['dob'];
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
          var year = $('#dob_year').get(0);
          var month = $('#dob_month').get(0);
          var day = $('#dob_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dob'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dob'] == null;
          }
          else {
            info['dob'] = month.value + " " + day.value + ", " + year.value;
          }
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
    From
    <select id="dates1-from_month" name="dates1-from_month">
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
    <select id="dates1-from_day" name="dates1-from_day">
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
    <select id="dates1-from_year" name="dates1-from_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates1-from_year').get(0);
          var month = $('#dates1-from_month').get(0);
          var day = $('#dates1-from_day').get(0);
          
          var value = info['dates1-from'];
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
          var year = $('#dates1-from_year').get(0);
          var month = $('#dates1-from_month').get(0);
          var day = $('#dates1-from_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates1-from'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates1-from'] == null;
          }
          else {
            info['dates1-from'] = month.value + " " + day.value + ", " + year.value;
          }
        });
      //]]>
    </script>
    to
    <select id="dates1-to_month" name="dates1-to_month">
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
    <select id="dates1-to_day" name="dates1-to_day">
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
    <select id="dates1-to_year" name="dates1-to_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates1-to_year').get(0);
          var month = $('#dates1-to_month').get(0);
          var day = $('#dates1-to_day').get(0);
          
          var value = info['dates1-to'];
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
          var year = $('#dates1-to_year').get(0);
          var month = $('#dates1-to_month').get(0);
          var day = $('#dates1-to_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates1-to'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates1-to'] == null;
          }
          else {
            info['dates1-to'] = month.value + " " + day.value + ", " + year.value;
          }
        });
      //]]>
    </script>
  </div>
  <div class="field">
    <label for="dates2-from">
      Second preference of dates
    </label>
    <br />
    From
    <select id="dates2-from_month" name="dates2-from_month">
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
    <select id="dates2-from_day" name="dates2-from_day">
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
    <select id="dates2-from_year" name="dates2-from_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates2-from_year').get(0);
          var month = $('#dates2-from_month').get(0);
          var day = $('#dates2-from_day').get(0);
          
          var value = info['dates2-from'];
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
          var year = $('#dates2-from_year').get(0);
          var month = $('#dates2-from_month').get(0);
          var day = $('#dates2-from_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates2-from'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates2-from'] == null;
          }
          else {
            info['dates2-from'] = month.value + " " + day.value + ", " + year.value;
          }
        });
      //]]>
    </script>
    to
    <select id="dates2-to_month" name="dates2-to_month">
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
    <select id="dates2-to_day" name="dates2-to_day">
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
    <select id="dates2-to_year" name="dates2-to_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates2-to_year').get(0);
          var month = $('#dates2-to_month').get(0);
          var day = $('#dates2-to_day').get(0);
          
          var value = info['dates2-to'];
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
          var year = $('#dates2-to_year').get(0);
          var month = $('#dates2-to_month').get(0);
          var day = $('#dates2-to_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates2-to'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates2-to'] == null;
          }
          else {
            info['dates2-to'] = month.value + " " + day.value + ", " + year.value;
          }
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
    <select id="dates3-from_month" name="dates3-from_month">
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
    <select id="dates3-from_day" name="dates3-from_day">
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
    <select id="dates3-from_year" name="dates3-from_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates3-from_year').get(0);
          var month = $('#dates3-from_month').get(0);
          var day = $('#dates3-from_day').get(0);
          
          var value = info['dates3-from'];
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
          var year = $('#dates3-from_year').get(0);
          var month = $('#dates3-from_month').get(0);
          var day = $('#dates3-from_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates3-from'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates3-from'] == null;
          }
          else {
            info['dates3-from'] = month.value + " " + day.value + ", " + year.value;
          }
        });
      //]]>
    </script>
    to
    <select id="dates3-to_month" name="dates3-to_month">
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
    <select id="dates3-to_day" name="dates3-to_day">
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
    <select id="dates3-to_year" name="dates3-to_year">
      <option>[Year]</option>
      <option>2010</option>
      <option>2011</option>
      <option>2012</option>
      <option>2013</option>
    </select>
    <script type="text/javascript">
      //<![CDATA[
        load_handlers.push(function (info) {
          var year = $('#dates3-to_year').get(0);
          var month = $('#dates3-to_month').get(0);
          var day = $('#dates3-to_day').get(0);
          
          var value = info['dates3-to'];
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
          var year = $('#dates3-to_year').get(0);
          var month = $('#dates3-to_month').get(0);
          var day = $('#dates3-to_day').get(0);
          
          if (year.selectedIndex == 0 ^ month.selectedIndex == 0 ^ day.selectedIndex == 0) {
            // TODO: show validation error
            info['dates3-to'] == null;
          }
          else if (year.selectedIndex == 0) {
            info['dates3-to'] == null;
          }
          else {
            info['dates3-to'] = month.value + " " + day.value + ", " + year.value;
          }
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
