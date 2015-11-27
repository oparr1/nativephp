<?php 
    $metaTitle = "MySqli Query";
    $metaDescription = "This is the Mysqli Query page";
    include('partials/header.php');
?>

<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col12">
            <section id="sqlqueries">
                <?php
                // Use require_once for DB
                require_once('../app/config/database.php');
                // Call the Function
                $conn = mysqliConnected();

                // Escape output safely - Required on all html OUTPUT from database
                function html($data) {
                  $data = htmlspecialchars($data, ENT_QUOTES); // <>
                    return $data;
                }
                ?>

                <h2>MySqli Queries</h2>

                <?php
                // One Value
                $sql = "SELECT name 
          			        FROM Country 
                        WHERE name = 'United Kingdom' 
                        LIMIT 1";
                $result = $conn->query($sql);
                ?>

                <h3>One Value</h3>
                <!-- If no results found e.g Where name = 'Fake Country' will return "No results found" -->
                <?php if ($result->num_rows > 0) : ?> 
                  <?php $row = $result->fetch_array(); ?>
                    <table><tr><td><?php echo html($row['name']); ?></td></tr></table>
                  <?php else : ?>
                    No results found
                <?php endif; ?>

                <!-- search a country -->
                <h3>Search a country (e.g Spain)</h3>

                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>

                    <!-- Clean input before post -->
                    <?php function clean_input($data, $default = NULL) {
                      return isset($_POST[$data]) ? stripslashes(trim($_POST[$data])) : $default;
                    } ?>

                    <!-- Only prepare statements for dynamic queries i.e paramaterised - with ? value and $variable -->
                    <?php if($statement = $conn->prepare("SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy 
                      FROM Country 
                      WHERE name = ? 
                      LIMIT 1")) : ?>
                          
                          <?php 
                          $statement->bind_param('s', $country);
                          $country = clean_input('country');
                          $statement->execute();
                          $result = $statement->get_result();
                            
                          if($result->num_rows > 0) : ?>
                            <?php $row = $result->fetch_array(); ?>
                              <table class='fluid_table'>
                                <tr>
                                  <th><strong>Code</strong></th>
                                  <th><strong>Country</strong></th>
                                  <th><strong>Continent</strong></th>
                                  <th><strong>Region</strong></th>
                                  <th><strong>Surface Area</strong></th>
                                  <th><strong>Population</strong></th>
                                  <th><strong>Life Expectancy</strong></th>
                                </tr>
                                <tr><td><?php echo html($row["Code"]); ?></td>
                                    <td><?php echo html($row["Country"]); ?></td>
                                    <td><?php echo html($row["Continent"]); ?></td>
                                    <td><?php echo html($row["Region"]); ?></td>
                                    <td><?php echo html($row["Surface_Area"]); ?></td>
                                    <td><?php echo html($row["Population"]); ?></td>
                                    <td><?php echo html($row["Life_Expectancy"]); ?></td></tr>
                              </table>
                          <?php else : ?>
                              Result not found
                          <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <form id="form" action="mysqli-query" method="post" novalidate>
                  <div class="form-group">
                    <input class="form-control" type="text" name="country" placeholder="Country">
                  </div>
                  <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" value="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>
                </form>

                <!-- One Row  -->
                <?php $sql = "SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy 
                        FROM Country 
                        WHERE name = 'United Kingdom' 
                        LIMIT 1";
                $result = $conn->query($sql); ?>

                <h3>One Row - Selected 7 Columns</h3>
                <div class='scrollit'>
                  <table class='fluid_table'>
                  <!-- Fetches Column Field Names -->
                  <?php $column_name = $result->fetch_fields(); ?>
                    <tr>
                <?php foreach ($column_name as $val) : ?>
                  <!-- Gets all field values -->
                  <th><strong><?php echo $val->name = str_replace('_', ' ', $val->name); ?></strong></th> 
                <?php endforeach; ?>
                    </tr>

                  <?php while($row = $result->fetch_assoc()) : ?>
                    <tr><td><?php echo html($row["Code"]); ?></td>
                    <td><?php echo html($row["Country"]); ?></td>
                    <td><?php echo html($row["Continent"]); ?></td>
                    <td><?php echo html($row["Region"]); ?></td>
                    <td><?php echo html($row["Surface_Area"]); ?></td>
                    <td><?php echo html($row["Population"]); ?></td>
                    <td><?php echo html($row["Life_Expectancy"]); ?></td></tr>
                  <?php endwhile; ?>
                  </table>
                </div>

                <!-- One Column  -->
                <?php $sql = "SELECT name 
                        FROM Country 
                        ORDER BY name 
                        ASC LIMIT 20";
                $result = $conn->query($sql); ?>

                <h3>One Column - First 20, Ascending Order</h3>
                <tr><th><strong>Countries</strong></th></tr>
                <table>

                  <!-- fetch_assoc - returns string field name as array -->
                  <?php while($row = $result->fetch_assoc()) : ?>
                    <tr><td><?php echo html($row["name"]); ?></td></tr>
                  <?php endwhile; ?>
                </table>

                <!-- Multiple Rows -->
                <?php $sql = "SELECT Code, Name AS Country, Continent, Region, SurfaceArea AS Surface_Area, Population, LifeExpectancy AS Life_Expectancy 
                        FROM Country 
                        WHERE name = 'United Kingdom' OR name = 'Netherlands' OR name = 'Spain' 
                        ORDER BY Code ASC 
                        Limit 3";
                $result = $conn->query($sql); ?>

                <h3>Multiple Rows - Selected 7 Columns</h3>
                <div class='scrollit'>
                  <table class='fluid_table'>

                    <!-- Fetches Column Field Names -->
                    <?php $column_name = $result->fetch_fields(); ?>
                    <tr>
                    <?php foreach ($column_name as $val) : ?>
                      <!-- gets all field values -->
                      <th><strong><?php echo $val->name = str_replace('_', ' ', $val->name); ?></strong></th>
                    <?php endforeach; ?>
                    </tr>

                    <!-- For each Way instead of - echo "<tr><td>".$row["Code"]."</td>"; -->
                    <?php while($row = $result->fetch_assoc()) : ?>
                      <?php $c = 0; // Our counter
                      $n = 7; // Each Nth iteration would be a new table row
                      ?>
                          <?php foreach($row as $field) : ?>
                              <?php if($c % $n == 0) : // If $c is divisible by $n... ?> 
                                <!-- New table row after every nth -->
                                </tr><tr>
                              <?php endif; $c++; ?>
                                <td><?php echo html($field); ?></td>
                          <?php endforeach; ?>
                    <?php endwhile; ?>
                  </table>
                </div>

              <!-- Aggregates -->
              <?php $sql = "SELECT AVG(LifeExpectancy) AS Life_Expectancy 
                       FROM Country 
                       WHERE Continent = 'Europe' 
                       Limit 1";
              $result = $conn->query($sql); ?>

              <h3>Average Life Expectancy in Europe (2 decimal places)</h3>
              <table>
                 <tr><th><strong>Average Life Expectancy in Europe</strong></th></tr>
                 <tr><td>
               <?php while($row = $result->fetch_array()) : ?>
                    <?php $rowDecimal = number_format((float)$row['Life_Expectancy'], 2, '.', '');
                    echo html($rowDecimal); ?>
               <?php endwhile; ?>
                </td></tr>
              </table>

              <!-- Group By -->
               <?php $sql = "SELECT Continent, Region, COUNT(*) AS Total_Countries 
                       FROM Country 
                       GROUP BY Continent, Region 
                       ORDER BY Total_Countries DESC";
               $result = $conn->query($sql); ?>

               <h3>Group By number of countries in each Region per Continent, Descending</h3>
               <table>
               <!-- Fetches Column Field Names -->
                  <?php $column_name = $result->fetch_fields(); ?>
                  <tr>
                  <?php foreach ($column_name as $val) : ?>
                    <th><strong><?php echo $val->name = str_replace('_', ' ', $val->name); // Gets all field values ?></strong></th>
                  <?php endforeach; ?>
                  </tr>

                  <?php while($row = $result->fetch_assoc()) : ?>
                    <tr><td><?php echo html($row["Continent"]); ?></td>
                    <td><?php echo html($row["Region"]); ?></td>
                    <td><?php echo html($row["Total_Countries"]); ?></td></tr>
                  <?php endwhile; ?>
                </table>

                <!-- Join Tables -->
               <?php $sql = "SELECT country.Name AS Country, GROUP_CONCAT(Language ORDER BY Language ASC) AS Official_Language 
                       FROM Country 
                       INNER JOIN countrylanguage ON country.Code = countrylanguage.CountryCode 
                       WHERE country.Continent = 'Europe' AND countrylanguage.IsOfficial = 'T' 
                       GROUP BY Name 
                       ORDER BY Name ASC ";
               $result = $conn->query($sql); ?>

               <h3>Join 2 Tables - Country and Official Languages in Europe</h3>
               <table>
               <tr><th><strong>Country</strong></th>
               <th><strong>Official Language(s)</strong></th></tr>

                <?php while($row = $result->fetch_assoc()) : ?>
                  <tr><td><?php echo html($row["Country"]); ?></td>
                  <td><?php echo html($row["Official_Language"]); ?></td></tr>
                <?php endwhile; ?>
              </table>

               <!-- Random List -->
               <?php $sql = "SELECT name as Country 
                       From Country 
                       WHERE name Like 'C%' 
                       ORDER BY RAND()";
              $result = $conn->query($sql); ?>

               <h3>Random List on refresh (beginning with 'C')</h3>
              <table>
                <!-- Fetches Column Field Names -->
                <?php $column_name = $result->fetch_fields(); ?>
                <tr>
                <?php foreach ($column_name as $val) : ?>
                  <th><strong><?php echo $val->name = str_replace('_', ' ', $val->name); // Gets all field values ?></strong></th> 
                <?php endforeach; ?>
                </tr>
                <?php while($row = $result->fetch_assoc()) : ?>
                <tr><td><?php echo html($row["Country"]); ?></td></tr>
                <?php endwhile; ?>
              </table>

              <!-- Close connection -->
              <?php $conn->close(); ?>
           </section>
        </div>
    </div> <!-- Row Closing -->
</div> <!-- 1200 Closing -->

<?php include('partials/footer.php'); ?>