<h1>HOW DO I USE ZMVC?</h1>

<p>The first thing ZMVC checks for is the dependant files, namely the ones in the ZMVC directory:</p>

<pre>
ZMVC/Model.php
ZMVC/View.php
ZMVC/Controller.php
ZMVC/ZMVC.php
</pre>

<p>Without these ZMVC can't get going. The model/view/controller pattern is used but without having to extend or interact with them in any way. Before we get started let's check what configuration is possible when initialising ZMVC in the index.php file.</p>

<h2 id="config">Config</h2>

<pre>
$ZMVC = new ZMVC(array(
	"ZMVCPath"			=> (string)
	"Applications"			=> (array)
	"DefaultApplication"		=> (string)
	"ApplicationTemplates"		=> (string)
	"ApplicationModels"		=> (string)
	"ApplicationViews"		=> (string)
	"ApplicationControllers"	=> (string)
	"PageRequestVariable"		=> (string)
	"DefaultTemplate"		=> (string)
	"DefaultPage"			=> (string)
	"DefaultAcceptParams"		=> (string)
));
</pre>

<p>If any key value pairs are left out when initialising they will be left to default, you can check what these are in the ZMVC/ZMVC.php file.</p>

<p>After this ZMVC will attempt to launch the controller, which in turn will load the appropriate model and view. The default application is named "Application", you can change this by modifying
"DefaultApplication". if you would like to have other applications you can add them to the "Applications" array when inistialising ZMVC by using the key value pair:</p>

<pre>
"Applications"	=> array("application2" => "Application2")
</pre>

<p>Now you could access this application by prepending "application2" to your page path in the URL eg. "mysite.com/application2/"</p>

<h2 id="models-and-views">Models and Views</h2>

<p>Both Models and views are selected the same way, let's use an example file structure:</p>

<pre>
1. Application/Models/home.php
2. Application/Models/page.php
4. Application/Models/somedir/home.php
5. Application/Models/somedir/anotherpage.php
</pre>

<p>The controller will select the correct model based on what is passed through the URL, the below would examples would select the above numbered examples:</p>

<pre>
1. /
2. /page
4. /somedir
5. /somedir/anotherpage
</pre>

<p>Note the home.php is special, and will be selected if no page is passed, whether that be 0 or many directories deep.</p>

<h2 id="passing-parameters">Passing parameters</h2>

<p>To pass parameters ($_GET variables) to a page you can simply append them to the url like this:</p>

<pre>
/page/value1/value2
</pre>

<p>Now the page model can access this values by using the global $_GET array eg:</p>

<pre>
$_GET["param_1"] // = value1
$_GET["param_2"] // = value2
</pre>

<p>This would numerically continue for as many parameters that are added. If you do not wish the user to pass parameters to a page you can set the model "AcceptParams" property eg:</p>

<pre>
# Application/Models/page.php
$this->AcceptParams = false
</pre>

<h2>More to come...</h2>

<p>There is much more to explain, I'm getting there...</p>

<p><br /><br /><br /><br /></p>