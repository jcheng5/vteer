<?php $base_url = base_url() . 'static/lib/yui/'; ?>
<!-- Configuration URL:
http://developer.yahoo.com/yui/articles/hosting/?button&calendar&menu&MIN&nocombine&norollup&basepath&${base_url}&google
-->

<?php echo <<<INCLUDES
<!-- Individual YUI CSS files -->
<link rel="stylesheet" type="text/css" href="${base_url}menu/assets/skins/sam/menu.css">
<link rel="stylesheet" type="text/css" href="${base_url}button/assets/skins/sam/button.css">
<link rel="stylesheet" type="text/css" href="${base_url}calendar/assets/skins/sam/calendar.css">
<!-- Individual YUI JS files -->
<script type="text/javascript" src="${base_url}yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="${base_url}dom/dom-min.js"></script>
<script type="text/javascript" src="${base_url}event/event-min.js"></script>
<script type="text/javascript" src="${base_url}container/container_core-min.js"></script>
<script type="text/javascript" src="${base_url}menu/menu-min.js"></script>
<script type="text/javascript" src="${base_url}element/element-min.js"></script>
<script type="text/javascript" src="${base_url}button/button-min.js"></script>
<script type="text/javascript" src="${base_url}calendar/calendar-min.js"></script>
INCLUDES;
?>