<h1>PDO Query</h1>

<?php
// Use require_once for DB
require_once('config/database.php');
// Call the Function
$conn = pdoConnected();
$conn->exec("set names utf8");

// XSS - htmlspecialchars
// sqlinjection - prepared statement / mysqli_real_escape_string();

// Escape output safely - only use on echo / OUTPUT
function html($data) {
  $data = htmlspecialchars($data, ENT_QUOTES); // <>

    return $data;
}

// PDO statements
// Prepared statements, execute and bind paramater for increased security

// Define Query
// Prepare
// Bind Paramater/Value -- Only works on field values
// Execute

// One Value
$statement = $conn->prepare("SELECT name 
                             FROM country 
                             WHERE name = ?");
$statement->bindValue(1, "United Kingdom"); 
$statement->execute();

echo "<h3>One Value</h3>";
while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<table><tr><td>".html($row['name'])."</td></tr></table>";
}


// Search country

echo "<h3>Search a country</h3>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

          // Clean input before post
          function clean_input($data, $default = NULL) {
            return isset($_POST[$data]) ? stripslashes(trim($_POST[$data])) : $default;
          }

          // Only prepare statements for dynamic queries i.e paramaterised - with ? value and $variable
          if($statement = $conn->prepare("SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy 
            FROM Country 
            WHERE name = :country 
            LIMIT 1")) 
          {
                $statement->bindParam(':country', $country);
                $country = clean_input('country');
                $statement->execute();

                if($statement->rowCount() > 0 ) 
                {
                  $row = $statement->fetch(PDO::FETCH_ASSOC);
                  echo "<table class='fluid_table'>
                          <tr>
                            <th><strong>Code</strong></th>
                            <th><strong>Country</strong></th>
                            <th><strong>Continent</strong></th>
                            <th><strong>Region</strong></th>
                            <th><strong>Surface Area</strong></th>
                            <th><strong>Population</strong></th>
                            <th><strong>Life Expectancy</strong></th>
                          </tr>";
                  echo "<tr><td>".html($row["Code"])."</td>";
                  echo "<td>".html($row["Country"])."</td>";
                  echo "<td>".html($row["Continent"])."</td>";
                  echo "<td>".html($row["Region"])."</td>";
                  echo "<td>".html($row["Surface_Area"])."</td>";
                  echo "<td>".html($row["Population"])."</td>";
                  echo "<td>".html($row["Life_Expectancy"])."</td></tr>";
                  echo "</table>";
                }
                else {
                    echo "Result not found";

                }  
            }                              
    }

      echo "<form id='form' action='pdo-query' method='post' novalidate>
              <div class='form-group'>
                <input class='form-control' type='text' name='country' placeholder='Country'>
              </div>
              <div class='form-group'>
                <div class='col-md-offset-2 col-md-10'>
                    <button type='submit' value='submit' class='btn btn-default'>Submit</button>
                </div>
              </div>
            </form>";

// One Row
$statement = $conn->prepare("SELECT code, name as country, continent, region, surfacearea as surface_area, population, lifeexpectancy as life_expectancy FROM country WHERE name = ?");
$statement->bindValue(1, "United Kingdom"); 
$statement->execute();

echo "<h3>One Row - Selected 7 Columns</h3>";
echo "<tr><th><strong>Code</strong></th>
          <th><strong>Country</strong></th>
          <th><strong>Continent</strong></th>
          <th><strong>Region</strong></th>
          <th><strong>Surface Area</strong></th>
          <th><strong>Population</strong></th>
          <th><strong>Life Expectancy</strong></th>
     </tr>";
echo "<div class='scrollit'>";
echo "<table class='fluid_table'>";

while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>".html($row["code"])."</td>";
    echo "<td>".html($row["country"])."</td>";
    echo "<td>".html($row["continent"])."</td>";
    echo "<td>".html($row["region"])."</td>";
    echo "<td>".html($row["surface_area"])."</td>";
    echo "<td>".html($row["population"])."</td>";
    echo "<td>".html($row["life_expectancy"])."</td></tr>";
}
echo "</table>";
echo "</div>";

// One Column
$statement = $conn->prepare("SELECT name 
                             FROM Country 
                             ORDER BY name 
                             ASC LIMIT 20");
$statement->execute();

echo "<h3>One Column - First 20, Ascending Order</h3>";
echo "<tr><th><strong>Countries</strong></th></tr>";
echo "<table>";

while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<table><tr><td>".html($row['name'])."</td></tr></table>";
}
echo "</table>";

// Multiple Rows
// Cannot ORDER BY PARAM - Easiest way is to Order by the where clause
$statement = $conn->prepare("SELECT code, name as country, continent, region, surfacearea as surface_area, population, lifeexpectancy as life_expectancy 
                             FROM country 
                             WHERE code = ?");
$multipleRows = array('NLD', 'ESP', 'GBR');
// Ordering by code
sort($multipleRows);

echo "<h3>Multiple Rows - Selected 7 Columns</h3>";
echo "<tr><th><strong>Code</strong></th>
          <th><strong>Country</strong></th>
          <th><strong>Continent</strong></th>
          <th><strong>Region</strong></th>
          <th><strong>Surface Area</strong></th>
          <th><strong>Population</strong></th>
          <th><strong>Life Expectancy</strong></th>
     </tr>";
echo "<div class='scrollit'>";
echo "<table class='fluid_table'>";

foreach($multipleRows as $mr) {
$statement->bindParam(1, $mr); 
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".html($row["code"])."</td>";
        echo "<td>".html($row["country"])."</td>";
        echo "<td>".html($row["continent"])."</td>";
        echo "<td>".html($row["region"])."</td>";
        echo "<td>".html($row["surface_area"])."</td>";
        echo "<td>".html($row["population"])."</td>";
        echo "<td>".html($row["life_expectancy"])."</td></tr>";
}
      echo "</table>";
      echo "</div>";
}

// Aggregates
$statement = $conn->prepare("SELECT AVG(LifeExpectancy) AS Life_Expectancy 
         FROM Country 
         WHERE Continent = ? 
         Limit 1");

$statement->bindValue(1, "Europe"); 
$statement->execute();

echo "<h3>Average Life Expectancy in Europe (2 decimal places)</h3>";
echo "<table>";
echo "<tr><th><strong>Average Life Expectancy in Europe</strong></th></tr>";
echo "<tr><td>";

while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $rowDecimal = number_format((float)$row['Life_Expectancy'], 2, '.', '');
    echo "<table><tr><td>".html($rowDecimal)."</td></tr></table>";
}
    echo "</table>";

// Group By - Find way to use prepared statement for e.g Where = Europe
$statement = $conn->prepare("SELECT Continent, Region, COUNT(*) AS Total_Countries 
     FROM Country 
     GROUP BY Continent, Region 
     ORDER BY Total_Countries DESC");
$statement->execute();

echo "<h3>Group By number of countries in each Region per Continent, Descending</h3>";
echo "<tr><th><strong>Continent</strong></th>
          <th><strong>Region</strong></th>
          <th><strong>Total Countries</strong></th>
     </tr>";

echo "<table>";
      while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".html($row["Continent"])."</td>";
        echo "<td>".html($row["Region"])."</td>";
        echo "<td>".html($row["Total_Countries"])."</td></tr>";
      }
      echo "</table>";

 // Join Tables
$statement = $conn->prepare("SELECT country.Name AS Country, GROUP_CONCAT(Language ORDER BY Language ASC) AS Official_Language 
             FROM Country 
             INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode 
             WHERE country.Continent = 'Europe' AND countrylanguage.IsOfficial = 'T' 
             GROUP BY Name 
             ORDER BY Name ASC ");
$statement->execute();

echo "<h3>Join 2 Tables - Country and Official Languages in Europe</h3>";
echo "<table>";
echo "<tr><th><strong>Country</strong></th>";
echo "<th><strong>Official Language(s)</strong></th></tr>";

while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
echo "<tr><td>".html($row["Country"])."</td>";
echo "<td>".html($row["Official_Language"])."</td></tr>";
}
echo "</table>";

// Random List
$statement = $conn->prepare("SELECT name as Country 
     From Country 
     WHERE name LIKE ? 
     ORDER BY RAND()");
$statement->bindValue(1, 'C%');
$statement->execute();

     echo "<h3>Random List on refresh (beginning with 'C')</h3>";
     echo "<tr><th><strong>Countries</strong></th>";
      echo "<table>";

       while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".html($row["Country"])."</td></tr>";
      }
      echo "</table>";

$conn = null;

?>







