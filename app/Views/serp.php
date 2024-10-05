<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XS Mobile App by Rayyan Technologies</title>
</head>
<body>
    <form action="serp" method="post">
        <p>Search In the Box Below</p>
        <input type="text" placeholder="Search anything">
        <input type="submit" value="Search">
    </form>

    <br><br><hr>
    <center><font size="3" face="verdana" color="red">
        Search Result
    </font></center>
    <p><?=$res?></p>
</body>
</html>