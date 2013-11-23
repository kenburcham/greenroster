<?php

class NavMenu
{
    public static function getCheckinMenu()
    {
        $html = '<ul class="nav-bar">';
        $html .= '<li class="active"><a href="/index.php/admin">Lost and Found</a></li>';
        $html .= '</ul>';
        
        return $html;
    }
    
    //returns the menu built for the current user
    public static function getMenu()
    {
        
        $html = '<ul class="nav-bar">';
        $html .= '<li class="active"><a href="/index.php/admin">Lost and Found</a></li>';

        
        //if user is logged in
        
        //if user is leader role
        
        //if user is admin role
        $html .= NavMenu::getAdminMenu();
   
        //$html .= "<li><a href='#'>Reports</a></li>";

        
        $html .= '</ul>';
        
        return $html;
    }
    
    public static function getAdminMenu()
    {
$the_base = Yii::app()->params['base'];   
$username = Yii::app()->user->name;

$html = <<<EOT
  <li><a href="$the_base/admin">Meetings</a></li>
  <li class="has-flyout">
      <a href="#">Create Meeting</a>
        <a href="#" class="flyout-toggle"><span> </span></a>
        <ul class="flyout">
EOT;

foreach(Event::model()->findAll() as $event)
{
    $html .= "<li>" . CHtml::link($event->name,array("admin/startEvent", "id" => $event->id)) . "</li>";
}
        $html .= "</ul></li>";



$html .= <<<EOT
<li class="has-flyout">
    <a href="#">Manage</a>
    <a href="#" class="flyout-toggle"><span> </span></a>
    <ul class="flyout">
      <li><a href="$the_base/user/admin">Users</a></li>
      <li><a href="$the_base/event/admin">Groups</a></li>
      <li><a href="$the_base/eventLocation/admin">Group Locations</a></li>
      <li><a href="$the_base/eventType/admin">Group Types</a></li>
    </ul>
  </li>
<li class="has-flyout">        
  <a href="#">Reports</a>
    <a href="#" class="flyout-toggle"><span> </span></a>
    <ul class="flyout">
      <li><a href="$the_base/report/attendance">Attendance</a></li>
      <li><a href="$the_base/report/meetings">Meetings</a></li>  
      <li><a href="$the_base/report/totals">Totals (not yet)</a></li>
      <li><a href="$the_base/report/rosters">Group Rosters</a></li>
      <li><a href="$the_base/report/leaders">Leader List (not yet)</a></li>
      <li><a href="$the_base/report/participants">Participant List (not yet)</a></li>
        
    </ul>
  </li>
  <li class="divider"></li>
  <li class="has-flyout" style="float: right;">
        <a href="#">Hi $username</a>
            <a href="#" class="flyout-toggle"><span> </span></a>
            <ul class="flyout">
                <li><a href="$the_base/site/logout">Logout</a></li>
            </ul>
  </li>
  
EOT;
        return $html;
    }
    
}

/*
 * <li class="has-flyout">
    <a href="#">Manage</a>
    <a href="#" class="flyout-toggle"><span> </span></a>
    <ul class="flyout">
      <li><a href="user">Users</a></li>
      <li><a href="event">Events</a></li>
      <li><a href="eventLocation">Event Locations</a></li>
      <li><a href="eventType">Event Types</a></li>
    </ul>
  </li>
 */

/*
<ul class="nav-bar">
  <li class="active"><a href="/index.php/site">Lost and Found</a></li>
  <li class="has-flyout">
    <a href="#">Admin</a>
    <a href="#" class="flyout-toggle"><span> </span></a>
    <ul class="flyout">
      <li><a href="user">Users</a></li>
      <li><a href="event">Events</a></li>
      <li><a href="eventLocation">Event Locations</a></li>
      <li><a href="eventType">Event Types</a></li>
    </ul>
  </li>
  <li><a href="#">Reports</a></li>
</ul>
*/