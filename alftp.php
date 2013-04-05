<?php

function get_filesize($dsize) { 
    if (strlen($dsize) <= 9 && strlen($dsize) >= 7) { 
        $dsize = number_format($dsize / 1048576, 1); 
        return "$dsize MB"; 
    } elseif (strlen($dsize) >= 10) { 
        $dsize = number_format($dsize / 1073741824, 1); 
        return "$dsize GB"; 
    } elseif(strlen($dsize) >= 4) { 
        $dsize = number_format($dsize / 1024, 1); 
        return "$dsize KB"; 
    } else { 
        return "$dsize bytes"; 
    } 
}

function run($wf) {
	$data = load($wf);
	$list = array();
    $search = strtolower($GLOBALS["query"]);

    foreach($data as $item) {
    	if(!empty($search) && strpos(strtolower($item["name"]), $search) === false) {
    		continue;
    	}
    	
    	// timestamps should have the same width for sorting
        $list["key_${item['timestamp']}"] = $item;
    }

    output($wf, $list);
}

function load($wf) {
	$cache_file = $wf->cache() ."/cache-". preg_replace('/[^a-z0-9_-]/i', '', $GLOBALS["url"]);
	// echo "cache file is $cache_file\n";

	$cache_time = 5 * 60; // 5min
	if(file_exists($cache_file) && time() - filemtime($cache_file) < $cache_time) {
		return unserialize(file_get_contents($cache_file));
	}

	$options = array(
	    CURLOPT_CONNECTTIMEOUT=>10,
	    CURLOPT_USERPWD=>$GLOBALS["auth"],
	    CURLOPT_FAILONERROR=>true,
	    CURLOPT_CUSTOMREQUEST=>"LIST ". $GLOBALS['root']
	);
	$lines = explode("\n", $wf->request($GLOBALS["url"], $options));

	$data = array();
	foreach($lines as $line) {
		// echo ">>>$line<<<\n";
		if(empty($line)) continue;

	    preg_match_all('/(?P<flag>[dl-])[rwx-]+\s+(?P<contents>\d+).+?(?P<size>\d+)\s+(?P<month>\w+)\s+(?P<date>\d+)\s+(?P<time_or_year>[\d:]+)\s+(?P<name>\S+)/', $line, $out, PREG_SET_ORDER);

	    // ignore invalid line 
	    if(!count($out)) continue;
	    print_r($out);

	    $match = $out[0];
	    $pattern = strpos($match["time_or_year"], ':') === false ? "Y" : "H:i";
	    $timezone = new DatetimeZone($GLOBALS["server_timezone"]);

	    $date = DateTime::createFromFormat("M d $pattern", $match["month"]." ".$match["date"]." ".$match["time_or_year"], $timezone);
	    if($date > date_create("now", $timezone)) {
	    	$date->sub(new DateInterval("P1Y"));
	    }
	    $timestamp = $date->getTimestamp();

	    $keys = array('name', 'size', 'flag');
	    $match = array_intersect_key($match, array_flip($keys));

	    $match["timestamp"] = $timestamp;
	    $match["lastmodifieddate"] = $date->format($GLOBALS["date_format"]);
	    $data[] = $match;
	};

	file_put_contents($cache_file, serialize($data));
	return $data;
}

function output($wf, $list) {
	if(count($list)) {
	    krsort($list);
	    foreach($list as $index=>$entry) {
	        $wf->result($index, $entry["name"], $entry["name"], ($entry["flag"] == '-' ? get_filesize($entry["size"]) : 'Directory') .", available since ". $entry["lastmodifieddate"], $entry["flag"] == 'd' ? 'folder.png' : 'item.png');
	    }
	} else {
		if($GLOBALS["query"]) {
		    $wf->result(-1, '', 'Item not found', 'Try to input less characters...', 'warning.png', false);

		} else {
		    $wf->result(-1, '', 'Cannot parse list of the root directory', 'Please check the settings.', 'warning.png', false);

		}
	}

	echo $wf->toxml();
}

function on_error($errno, $errstr, $errfile, $errline) {
	$wf = $GLOBALS["wf"];
	$desc = "($errno) $errstr";

	// show error source if error not raised by user (trigger_error) 
	if($errno != 1024) {
		$desc = array_pop(explode('/', $errfile)) .":$errline - $desc";
	}

	$wf->result(-1, '', "Error found, check message below", $desc, 'error.png', false);
	echo $wf->toxml();

	exit($errno);
}

set_error_handler('on_error');
$query = trim($query);
$wf = new Workflows();
run($wf);

?>