<form method="POST" action="process1.php">

Name: <input type="text" name="name"><br><br>

Password: <input type="password" name="password"><br><br>

Gender:
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<br><br>

Hobbies:
<input type="checkbox" name="hobby[]" value="Reading"> Reading
<input type="checkbox" name="hobby[]" value="Music"> Music
<input type="checkbox" name="hobby[]" value="Sports"> Sports
<br><br>

City:
<select name="city">
    <option value="Delhi">Delhi</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Noida">Noida</option>
</select>
<br><br>

Message:
<textarea name="message"></textarea>
<br><br>

<input type="submit" value="Submit">

</form>