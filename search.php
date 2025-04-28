<html>
<head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .search {
    background-color: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
  }
  .search h3 {
    margin-bottom: 15px;
    color: #333;
  }
  .search input[type="text"] {
    padding: 10px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 10px;
  }
  .search button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }
  .search button:hover {
    background-color: #0056b3;
  }
  .search p {
    margin-top: 15px;
    font-size: 16px;
    color: #555;
  }
  .search b {
    color: #007bff;
  }
</style>
</head>

<header>
<section class="search">
    <h3>Search Our Services</h3>
    <form method="GET" action="search.php">
        <input type="text" name="query" placeholder="Search something...">
        <button type="submit">Search</button>
    </form>

    <?php
    if (isset($_GET['query'])) {
        $search = $_GET['query']; 
        
        // Display the user input without any sanitization (unsafe, vulnerable to XSS)
        echo "<p>You searched for: <b>$search</b></p>";
    }
    ?>
</section>
</header>
</html>
