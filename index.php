<?php
  // Build out URI to reload from form dropdown
  // Need full url for this to work in Opera Mini
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

  if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
     $pageURL .= $_POST[sg_uri].$_POST[sg_section_switcher];
     header("Location: $pageURL");
  }

  // Display title of each markup samples as a select option
  function listMarkupAsOptions ($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file); 
        $title = preg_replace("/\-/i", " ", $filename);
        $title = ucwords($title);
        echo '<option value="#sg-'.$filename.'">'.$title.'</option>';
    endforeach;
  }

  // Display markup view & source
  function showMarkup($type) {
    $files = array();
    $handle=opendir('markup/'.$type);
    while (false !== ($file = readdir($handle))):
        if(stristr($file,'.html')):
            $files[] = $file;
        endif;
    endwhile;

    sort($files);
    foreach ($files as $file):
        $filename = preg_replace("/\.html$/i", "", $file);
        $title = preg_replace("/\-/i", " ", $filename);
        $documentation = 'doc/'.$type.'/'.$file;
        echo '<div class="sg-markup sg-section">';
        echo '<div class="sg-display">';
        echo '<h2 class="sg-h2"><a id="sg-'.$filename.'" class="sg-anchor">'.$title.'</a></h2>';
        if (file_exists($documentation)) {
          echo '<div class="sg-doc">';
          echo '<h3 class="sg-h3">Usage</h3>';
          include($documentation);
          echo '</div>';
        }
        echo '<h3 class="sg-h3">Example</h3>';
        include('markup/'.$type.'/'.$file);
        echo '</div>';
        echo '<div class="sg-markup-controls"><a class="sg-btn sg-btn--source" href="#">View Source</a> <a class="sg-btn--top" href="#top">Back to Top</a> </div>';
        echo '<div class="sg-source sg-animated">';
        echo '<a class="sg-btn sg-btn--select" href="#">Copy Source</a>';
        echo '<pre class="prettyprint linenums"><code>';
        echo htmlspecialchars(file_get_contents('markup/'.$type.'/'.$file));
        echo '</code></pre>';
        echo '</div>';
        echo '</div>';
    endforeach;
  }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
    <title>Style Guide Boilerplate</title>
    <meta name="viewport" content="width=device-width">
    <!-- Style Guide Boilerplate Styles -->
    <link rel="stylesheet" href="css/sg-style.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- J-Template stylesheets -->
    <!-- Experiment: brick font loader -->
    <link rel="stylesheet" href="//brick.a.ssl.fastly.net/Fira+Sans:300,300i,400,400i,500,500i,700,700i">

    <!-- J-Template stylesheet -->
    <link rel="stylesheet" href="css/j-template.css">

</head>
<body>
    
<div id="top" class="sg-header sg-container">
  <h1 class="sg-logo">adhocgraFX Template <span>Style Guide</span></h1>
  <form id="js-sg-nav" action=""  method="post" class="sg-nav">
    <select id="js-sg-section-switcher" class="sg-section-switcher" name="sg_section_switcher">
        <option value="">Jump To Section:</option>
        <optgroup label="Intro">
          <option value="#sg-about">About</option>
          <option value="#sg-colors">Colors</option>
          <option value="#sg-fontStacks">Font-Stacks</option>
        </optgroup>
        <optgroup label="Base Styles">
          <?php listMarkupAsOptions('base'); ?>
        </optgroup>
        <optgroup label="Pattern Styles">
          <?php listMarkupAsOptions('patterns'); ?>
        </optgroup>
    </select>
    <input type="hidden" name="sg_uri" value="<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>">
    <button type="submit" class="sg-submit-btn">Go</button>
  </form><!--/.sg-nav-->
</div><!--/.sg-header-->

<div class="sg-body sg-container adhoc-wrapper">
  <div class="sg-info">               
    <div class="sg-about sg-section">
      <h2 class="sg-h2"><a id="sg-about" class="sg-anchor">About</a></h2>
      <p>Joomla!<sup>&reg;</sup> base template markup and css styles.</p>
        <ul>
            <li>normalize css v3</li>
            <li>basics: add. css ideas plus html5 boilerplate helper classes</li>
            <li>typo: base typographic styles</li>
            <li>tables</li>
            <li>forms</li>
            <li>buttons</li>
            <li>images and media</li>
            <li>alerts</li>
            <li>breadcrumbs</li>
            <li>module chrome</li>
            <li>nav</li>
        </ul>
    </div><!--/.sg-about-->
    
    <div class="sg-colors sg-section">
      <h2 class="sg-h2"><a id="sg-colors" class="sg-anchor">light blue color scale</a></h2>
        <div class="sg-color sg-color--a"><span class="sg-color-swatch"><span class="sg-animated">#88ffda</span></span></div>
        <div class="sg-color sg-color--b"><span class="sg-color-swatch"><span class="sg-animated">#4dd3c9</span></span></div>
        <div class="sg-color sg-color--c"><span class="sg-color-swatch"><span class="sg-animated">#339db0</span></span></div>
      <h2 class="sg-h2">dark gray color scale</h2>
        <div class="sg-color sg-color--d"><span class="sg-color-swatch"><span class="sg-animated">#2078aa</span></span></div>
        <div class="sg-color sg-color--e"><span class="sg-color-swatch"><span class="sg-animated">#3a517a</span></span></div>
      <h2 class="sg-h2">dark blue color scale</h2>
        <div class="sg-color sg-color--f"><span class="sg-color-swatch"><span class="sg-animated">#384355</span></span></div>
        <div class="sg-color sg-color--g"><span class="sg-color-swatch"><span class="sg-animated">#2078aa</span></span></div>
        <div class="sg-color sg-color--h"><span class="sg-color-swatch"><span class="sg-animated">#3a517a</span></span></div>

        <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-colors-->
    
    <div class="sg-font-stacks sg-section">
      <h2 class="sg-h2"><a id="sg-fontStacks" class="sg-anchor">Font Stacks</a></h2>
      <p class="sg-font sg-font-primary">'Fira Sans', Helvetica, Arial, 'Droid Sans', sans-serif;</p>
      <p class="sg-font sg-font-secondary">Georgia, Times, "Times New Roman", serif;</p>
      <div class="sg-markup-controls"><a class="sg-btn--top" href="#top">Back to Top</a></div>
    </div><!--/.sg-font-stacks-->
  </div><!--/.sg-info-->    

  <div class="sg-base-styles">    
    <h1 class="sg-h1">Base Styles</h1>
    <?php showMarkup('base'); ?>
  </div><!--/.sg-base-styles-->

  <div class="sg-pattern-styles">
    <h1 class="sg-h1">Pattern Styles<small> - Design and mark-up patterns unique to your site.</small></h1>
    <?php showMarkup('patterns'); ?>
    </div><!--/.sg-pattern-styles-->
  </div><!--/.sg-body-->

  <script src="js/sg-plugins.js"></script>
  <script src="js/sg-scripts.js"></script>
</body>
</html>
 