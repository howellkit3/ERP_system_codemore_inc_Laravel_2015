<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Draggable + Sortable</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
li { margin: 5px; padding: 5px; width: 150px; }
</style>
<script>
$(function() {
$( "#sortable" ).sortable({
revert: true
});
$( "#draggable" ).draggable({
connectToSortable: "#sortable",
helper: "clone",
revert: "invalid"
});
$( "ul, li" ).disableSelection();
});
</script>
</head>
<body>
<ul>
<li id="draggable" class="ui-state-highlight">Drag me down</li>
</ul>
<ul id="sortable">
dss
</ul>
</body>
</html>