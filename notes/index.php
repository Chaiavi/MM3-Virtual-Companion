<html>
    <head>
        <title>Notes</title>
    </head>
    <body>
        <?php
          define("FILE_NAME", "notes_dgh_mm3.txt");

          function Read()
          {
              echo @file_get_contents(FILE_NAME);
          }

          ;

          function Write()
          {
              $data = $_POST["textarea"];
              @file_put_contents(FILE_NAME, $data);
          }

          ?>

          <?php
          if ($_POST["submit_check"])
          {
              Write();
          }
		?>     

        <?php
        if ($_POST["submit_check"]){
            Write();
        };
        ?>      

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <textarea cols="80" rows="20" name="textarea"><?php Read(); ?></textarea>
        <br/><br/>
        <input type="submit" name="submit" value="Save Note">
        <input type="hidden" name="submit_check" value="1">
        </form>

        <?php
          if ($_POST["submit_check"]) {
            echo 'Notes Saved';
          };
        ?>      
    </body>
</html>