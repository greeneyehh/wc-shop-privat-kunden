<?php print_r($load);?>

<p><span class="description">Server Memory Usage:</span> <span class="result">= <?=$memory_usage;?> %</span></p>
<p><span class="description">Server CPU Usage: </span> <span class="result">= <?=$load[0];?> %</span></p>

<pre>
<?php print_r($df); ?>
</pre> 

<pre>
<?php print_r($uptime); ?>
</pre>
