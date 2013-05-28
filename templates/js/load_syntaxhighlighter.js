SyntaxHighlighter.autoloader(
	'applescript ./SyntaxHighlighter/scripts/shBrushAppleScript.js',
	'actionscript3 as3 ./SyntaxHighlighter/scripts/shBrushAS3.js',
	'bash shell sh ./SyntaxHighlighter/scripts/shBrushBash.js',
	'coldfusion cf ./SyntaxHighlighter/scripts/shBrushColdFusion.js',
	'cpp c ./SyntaxHighlighter/scripts/shBrushCpp.js',
	'c# c-sharp csharp ./SyntaxHighlighter/scripts/shBrushCSharp.js',
	'css ./SyntaxHighlighter/scripts/shBrushCss.js',
	'delphi pascal pas ./SyntaxHighlighter/scripts/shBrushDelphi.js',
	'diff patch ./SyntaxHighlighter/scripts/shBrushDiff.js',
	'erl erlang ./SyntaxHighlighter/scripts/shBrushErlang.js',
	'groovy ./SyntaxHighlighter/scripts/shBrushGroovy.js',
	'haxe hx ./SyntaxHighlighter/scripts/shBrushHaxe.js',
	'java ./SyntaxHighlighter/scripts/shBrushJava.js',
	'jfx javafx ./SyntaxHighlighter/scripts/shBrushJavaFX.js',
	'js jscript javascript ./SyntaxHighlighter/scripts/shBrushJScript.js',
	'perl Perl pl ./SyntaxHighlighter/scripts/shBrushPerl.js',
	'php ./SyntaxHighlighter/scripts/shBrushPhp.js',
	'text plain ./SyntaxHighlighter/scripts/shBrushPlain.js',
	'powershell ps posh ./SyntaxHighlighter/scripts/shBrushPowerShell.js',
	'py python ./SyntaxHighlighter/scripts/shBrushPython.js',
	'ruby rails ror rb ./SyntaxHighlighter/scripts/shBrushRuby.js',
	'sass scss ./SyntaxHighlighter/scripts/shBrushSass.js',
	'scala ./SyntaxHighlighter/scripts/shBrushScala.js',
	'sql ./SyntaxHighlighter/scripts/shBrushSql.js',
	'ts typescript ./SyntaxHighlighter/scripts/shBrushTypeScript.js',
	'vb vbnet ./SyntaxHighlighter/scripts/shBrushVb.js',
	'xml xhtml xslt html ./SyntaxHighlighter/scripts/shBrushXml.js'
);
SyntaxHighlighter.config.strings.expandSource = 'Quelltext anzeigen';
SyntaxHighlighter.config.strings.noBrush = 'Kann keine Zielsprache finden für: ';
SyntaxHighlighter.config.strings.brushNotHtmlScript = 'Zielsprache wurde nicht für html-script Option konfiguriert: ';
SyntaxHighlighter.all();