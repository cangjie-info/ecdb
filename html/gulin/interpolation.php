<?php 

//code for updating ref_gulin table with interpolated page numbers
//_GET values for page and gulin are set and preserved.
//QUERY: find next non-interpolated gulin number and page
$query = 'SELECT number, page 
          FROM ref_gulin
          WHERE number = 
            (SELECT MIN(number) 
                FROM ref_gulin 
                WHERE page_interpolated = 0 
                    AND number > ' . $gulin . ');';
$result = mysqli_query($link, $query);
if(!$result)
{
    $output = 'Error fetching next non-interpolated page: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}
$row = mysqli_fetch_array($result);
$next_number = $row['number'];
$next_page = $row['page'];
//QUERY: find previous non-interpolatd gulin number and page
$query = 'SELECT number, page 
          FROM ref_gulin
          WHERE number = 
            (SELECT MAX(number) 
                FROM ref_gulin 
                WHERE page_interpolated = 0 
                    AND number < ' . $gulin . ');';
$result = mysqli_query($link, $query);
if(!$result)
{
    $output = 'Error fetching previous non-interpolated page: ' . mysqli_error($link);
    include $includes . 'error.html.php';
    exit();
}
$row = mysqli_fetch_array($result);
$previous_number = $row['number'];
$previous_page = $row['page'];
$current_page = $_GET['page'];

$current_number = $gulin;
//if not monotonic >> error
if ((int)$current_page > (int)$next_page 
    or (int)$current_page < (int)$previous_page)
{
    $output = 'Page numbers must be monotonic increasing. Current page = ' . $current_page .
        ". Next page = $next_page. Previous page = $previous_page.";
    include $includes . 'error.html.php';
    exit();
}
//QUERY: set page for current gulin value, and interpolated to 0
$query = 'UPDATE ref_gulin
            SET page = "' . $current_page . '", page_interpolated = 0
            WHERE number = ' . $gulin .';';
if (!mysqli_query($link, $query))
{
    $output = "Error adding current page value. Query = $query.";
    include $includes . 'error.html.php';
    exit();
}
//QUERY: interpolate up to next non-interpolated value
    //setting page nubers and interpolated to 1.
$page_span = $next_page - $current_page;
$number_span = $next_number - $current_number;
$page_step = $page_span / $number_span;
$query = "UPDATE ref_gulin 
            SET page=LPAD(CAST($current_page + ($page_step * (number - $current_number)) AS UNSIGNED), 4, '0'),
                page_interpolated=1
            WHERE $current_number < number
                AND $next_number > number;";
if (!mysqli_query($link, $query))
{
    $output = "Error interpolating upwards. Query = $query.";
    include $includes . 'error.html.php';
    exit();
}

//QUERY: interpolate down to previous non-interpolated value
    //setting page numbers and interpolated to 1.

$page_span =  $current_page - $previous_page;
$number_span = $current_number - $previous_number;
$page_step = $page_span / $number_span;
$query = "UPDATE ref_gulin 
            SET page=LPAD(CAST($current_page - ($page_step * ($current_number - number)) AS UNSIGNED), 4, '0'),
                page_interpolated=1
            WHERE $current_number > number
                AND $previous_number < number;";
if (!mysqli_query($link, $query))
{
    $output = "Error interpolating downwards. Query = $query.";
    include $includes . 'error.html.php';
    exit();
}
