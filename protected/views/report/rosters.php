<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#accordion" ).accordion({heightStyle: "content", event: "click hoverintent"});
  });
  
  /*
   * hoverIntent | Copyright 2011 Brian Cherne
   * http://cherne.net/brian/resources/jquery.hoverIntent.html
   * modified by the jQuery UI team
   */
  $.event.special.hoverintent = {
    setup: function() {
      $( this ).bind( "mouseover", jQuery.event.special.hoverintent.handler );
    },
    teardown: function() {
      $( this ).unbind( "mouseover", jQuery.event.special.hoverintent.handler );
    },
    handler: function( event ) {
      var currentX, currentY, timeout,
        args = arguments,
        target = $( event.target ),
        previousX = event.pageX,
        previousY = event.pageY;
 
      function track( event ) {
        currentX = event.pageX;
        currentY = event.pageY;
      };
 
      function clear() {
        target
          .unbind( "mousemove", track )
          .unbind( "mouseout", clear );
        clearTimeout( timeout );
      }
 
      function handler() {
        var prop,
          orig = event;
 
        if ( ( Math.abs( previousX - currentX ) +
            Math.abs( previousY - currentY ) ) < 7 ) {
          clear();
 
          event = $.Event( "hoverintent" );
          for ( prop in orig ) {
            if ( !( prop in event ) ) {
              event[ prop ] = orig[ prop ];
            }
          }
          // Prevent accessing the original event since the new event
          // is fired asynchronously and the old event is no longer
          // usable (#6028)
          delete event.originalEvent;
 
          target.trigger( event );
        } else {
          previousX = currentX;
          previousY = currentY;
          timeout = setTimeout( handler, 100 );
        }
      }
 
      timeout = setTimeout( handler, 100 );
      target.bind({
        mousemove: track,
        mouseout: clear
      });
    }
  };
  </script>

<h2>Group Roster Explorer</h2>

<dl class="sub-nav">
  <dt>Period:</dt>
  <dd class='active'><a href="<?=$url?>?period=1">Forever</a></dd>
  <dd><a href="<?=$url?>?period=1">This year</a></dd>
  <dd><a href="<?=$url?>?period=1">60 days</a></dd>
</dl>  

<div id="accordion">

    <?php 
    foreach($events as $event)
    {
        ?>
        <h3><a href="#tab<?= $event->id ?>"><?= $event->name ?></a></h3>
   
            <div>
                <table class="open-meetings-table wide-table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>School</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td>Birthdate</td>
                            <td>First Contact</td>
                            <td>Notes</td>
                        </tr>
                    </thead>
                    <tbody>
                    
                <?php
                $attendees = $event->getRecentAttendeesOfType(AttendeeType::PARTICIPANT);
                foreach($attendees as $attendee)
                {?>
                        <tr><td>
                                <?php echo $attendee->user->firstname . " " . $attendee->user->lastname ?>
                            </td>
                            <td>
                                <?php echo $attendee->user->school ?>
                            </td>
                            <td>
                                <?php echo $attendee->user->phone ?>
                            </td>
                            <td>
                                <?php echo $attendee->user->address1. (($attendee->user->address1)? ', ': '') . $attendee->user->city ?>
                            </td>
                            <td>
                                <?php echo Yii::app()->dateFormatter->formatDateTime($attendee->user->dateofbirth, 'medium',null) ?>
                            </td>
                                <td>
                                <?php echo Yii::app()->dateFormatter->formatDateTime($attendee->user->firstcontact, 'medium',null) ?>
                            </td>
                            <td>
                                <?php echo $attendee->user->notes ?>
                            </td>
                            </tr>
                <?php
                }
                
                ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    ?>
</ul> 
