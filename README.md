Pretty PHP
============

Pretty PHP is a Textmate 2 bundle that formats (beautify) PHP source code.

Currently it has the following features:

- **Pretty PHP Features**:
	- can specifiy which PHP tag to use - could be <? or <?php or <?PHP
	- specify the tab size
	- choose spacees or tabs for indent 
	- choose the starting indent size 
	- use the One True Brace Style (K&amp;R)
	- add or remove space inside brackets
	- add newlines between structures
	- remove all comments if not wanted
	- choose to indent case/default statements, or not
	- remove blank lines
	- add space after if, for, while,  and do conditions
	- add space after commas and semi-colons
	- add spaces around math operators: * / + - =
	- add spaces around logical operators: &amp;&amp; ||
	- add spaces around equality operators: === !=== == !=
	- add spaces around relational operators: &lt;= &gt;= &lt; &gt;
	- add spaces around assignment operators: += -= *= /=
	- add spaces around bitwise operators: | &amp; ^ &gt;&gt; &lt;&lt; ~



Installation
------------

The installl the Pretty PHP bundle, simple double-click on the **Pretty PHP.tmbundle** file. This installs the bundle under Pretty PHP. 

If you want to install just the command in another bundle, simply double-click on the **Pretty PHP.tmCommand** file and choose the bundle to install into.

You can find more information on installing Textmate 2 bundles here: [http://blog.macromates.com/2011/locating-bundles/](http://blog.macromates.com/2011/locating-bundles/)

Configuration
----------------
From the Textmate 2 menu, select **Bundles** - **Edit Bundles...** and select the Pretty PHP bundle (assuming you installed the bundle and not the command). In the editor, select **Menu Actions** and click on **Pretty PHP**.

Scroll down to the Default Configuration section of the code and change the options as desired.

```php
//////////////// DEFAULT CONFIGURATION ///////////////////
/*                 Change as desired                    */
//////////////////////////////////////////////////////////

$PHP_TAG = "<?php";                             // PHP tag - could be <? or <?php or <?PHP
$TAB_SIZE = 2;                                  // tab size
$USE_SPACE = TRUE;                              // use space for tabs 
$START_INDENT = 0;                              // starting indent size 
$OTBS = TRUE;                                   // use the One True Brace Style (K&amp;R)
$BRACKET_SPACE = FALSE;                         // add space inside brackets
$NEWLINES = TRUE;                               // add newlines between structures
$REMOVE_COMMENTS = FALSE;                       // removes all comments
$INDENT_CASE = TRUE;                            // indent case/default statements
$REMOVE_EMPTY_LINES = FALSE;                    // remove blank lines - even if newlines were added
$SPACE_CONDITIONS = FALSE;                      // add space after if, for, while, do
$SPACE_PUNCTUATION = TRUE;                      // adds space after commas and semi-colons
$SPACE_MATH_OPERATORS = TRUE;                   // spaces around math operators: * / + - =
$SPACE_LOGIC_OPERATORS = TRUE;                  // spaces around logical operators: &amp;&amp; ||
$SPACE_EQUALITY_OPERATORS = TRUE;               // spaces around equality operators: === !=== == !=
$SPACE_RELATIONAL_OPERATORS = TRUE;             // spaces around relational operators: <= >= < >
$SPACE_ASSIGNMENT_OPERATORS = TRUE;             // spaces around assignment operators: += -= *= /=
$SPACE_BITWISE_OPERATORS = FALSE;               // spaces around bitwise operators: | &amp; ^ >> << ~


// Array used for adding space after statement
// Change to add spaces after statements as desired
$C_STRUCT = array("else", "elseif", "else if", "if", "do", "while", "for", "foreach", "switch");

// Array used for adding space after punctuation
// Change to add spaces after punctuation marks as desired
$S_PUNCTUATION = array(",", ";");

// Array used for adding space after conditions
// Change to add spaces after conditions as desired
$S_CONDITIONS = array("if","elseif", "do", "while", "for", "foreach", "switch");

```

You can also comment out functions you do not need or want. This will also help to speed up execution of the script.
```php
//////////////// CONTROL FUNCTIONS ///////////////////
/*             Comment out as desired               */
//////////////////////////////////////////////////////

$content = trimWhitespace($content);            // trim whitespace from lines
$content = cleanMLComments($content);           // clean multi-line comments
$content = cleanSLComments($content);           // clean single-line comments
$content = removeComments($content);            // remove unwanted comments

$content = delBlankLines($content);             // remove blank lines

$content = newLineBefore($content, "{");        // beginning of function
$content = newLineBefore($content, "}");        // end of function if not on own line

$content = newLineAfter($content, "{");         // start of function
$content = newLineAfter($content, "}");         // end of function
$content = newLineAfter($content, ";");         // end of line
$content = newLineAfter($content, ":");         // switch / case, etc.

$content = trimWhitespace($content);            // trim whitespace from lines

$content = addSpaceBefore($content,"*");        // align multi-line comment
$content = addBracketSpace($content);           // add space around brackets

$content = spaceOperators($content);            // spaces around math operators
$content = spaceConditions($content);           // add space after if, for, while, do
$content = spacePunctuation($content);          // adds space after commas and semi-colons

$content = formControlStructures($content);     // move opening brackets to end of lines
$content = removeBrackets($content);            // remove brackets from require/include statements
$content = doOneTrueBraceStyle($content);       // do One True Brace Style
$content = indentScript($content);              // indent the script
$content = doNewlines($content);                // add newlines before functions
```

Usage
-----
Pretty PHP can be activated from the Bundles menu, or by pressing `⇧-⌥-⌘-C`.

License
---------
Pretty PHP follows the MIT License, Anyone can freely use.

