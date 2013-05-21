<!DOCTYPE html>
<html>
    <head>
        <title>CKTest</title>
        <meta charset="UTF-8">
        <script src="./ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="./SyntaxHighlighter/scripts/shCore.js" type="text/javascript"></script>
        <script src="./SyntaxHighlighter/scripts/shAutoloader.js" type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" media="all" href="./SyntaxHighlighter/styles/shCore.css"></link>
        <link type="text/css" rel="stylesheet" media="all" href="./SyntaxHighlighter/styles/shThemeDefault.css"></link>
    </head>
    <body>
        <div style="width:980px;margin:auto">
            <h2>Welcome to our demo</h2>
            <h3>This page demonstates you the usage of the syntaxhighlighter-plugin in ckeditor 4.1 together with <a href="https://github.com/alexgorbatchev/SyntaxHighlighter" target="_blank">Alex Gorbatchev's syntaxhighlighter scripts</a></h3>
            <form action="index.php" method="POST">
                <textarea name="ta" cols="50" rows="10" id="ta"><?php if (isset($_POST) && array_key_exists('ta', $_POST)) echo get_magic_quotes_gpc() ? stripslashes($_POST['ta']) : $_POST['ta'];
else echo "<pre class=\"brush:cpp;toolbar:false;\">#include \"test.h\"\n\nint main (void) {\n   int foo = 0;\n\n   while (foo<1) foo=rand();\n\n   return 0;\n}</pre>" ?></textarea>
                <input type="submit" value="Send">
            </form>
            <hr>
            <div>
<?php if (isset($_POST) && array_key_exists('ta', $_POST)) echo get_magic_quotes_gpc() ? stripslashes($_POST['ta']) : $_POST['ta'];
else echo "<pre class=\"brush:cpp;toolbar:false;\">#include \"test.h\"\n\nint main (void) {\n   int foo = 0;\n\n   while (foo<1) foo=rand();\n\n   return 0;\n}</pre>" ?>
            </div>
            <script type="text/javascript"><!--
				CKEDITOR.replace('ta');
                            -- ></script>
            <script src="./load_syntaxhighlighter.js" type="text/javascript"></script>
            <hr>
            <p><a href="./cke_syntaxhighlighter_example.zip">Download complete source code as *.zip from here</a></p>
            <p>Please visit us at <a href="http://ckeditor.com/addon/syntaxhighlight" target="_blank">ckeditor.com</a> or <a href="https://github.com/dbrain/ckeditor-syntaxhighlight" target="_blank">github</a></p>
            <p>CKEditor and Alex Gorbatchev's syntaxhighlighter have been downloaded on 2013-03-31</p>
        </div>
    </body>
</html>