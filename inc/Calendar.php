<?php

/**
 * @package Travelbase
 */

namespace Inc;

class Calendar
{

	public function __construct()
	{

		if (get_option('travelbase_plugin_settings_activate')['calendar']) {
			add_shortcode('tbcalendar', array($this, 'calshortcode'));
		}
	}

	// register shortcode

	function calshortcode($atts, $content = null)
	{
		// set up default parameters
		extract(shortcode_atts(array(
			'bookingslink' => '',
			'projectid' => '',
			'tourid' => '',
			'summarydesc' => 'test',
			'summarylabel' => '',
			'summarytitleprice' => '',
			'summarybutton' => '',
			'summaryposttext' => '',
			'summarytitle' => '',
			'summarystart' => 'start',
			'summaryend' => 'end',
			'lang' => 'en',
			'waitinglistactive' => false,
			'waitinglistactivebtntext' => '',
			'waitinglistactiveurl' => ''
		), $atts));

		$html = '<div id="js-calendar"></div>';
?>
		<script>
			//calendar
			document.addEventListener("DOMContentLoaded", function() {
				try {
					var tripCalendar = new TripCalendar({
						el: "#js-calendar",
						json: '<?= "https://static.travelbase.eu/task/getTripJson/projectId/" . $projectid .  "/tourId/" . $tourid; ?>',
						data: {
							'trpclSummaryDesc': <?php echo json_encode($summarydesc); ?>,
							'trpclSummaryLabel': <?php echo json_encode($summarylabel); ?>,
							'trpclSummaryTitlePrice': <?php echo json_encode($summarytitleprice); ?>,
							'trpclSummaryButton': <?php echo json_encode($summarybutton); ?>,
							'trpclSummaryPosttext': <?php echo json_encode($summaryposttext); ?>,
							'trpclSummaryTitle': <?php echo json_encode($summarytitle); ?>,
							'trpclSummaryStart': <?php echo json_encode($summarystart); ?>,
							'trpclSummaryEnd': <?php echo json_encode($summaryend); ?>,
							'trpclLang': <?php echo json_encode($lang); ?>,
							'trpclWaitingListActive': <?php echo json_encode($waitinglistactive); ?>,
							'trpclWaitingListActiveBtnText': <?php echo json_encode($waitinglistactivebtntext); ?>
						},
						onInit: function(rootEl) {

						},
						onClickCalendar: function(item) {},
						onClickList: function(item) {},
						onSubmit: function(tripData) {

							var bookingLink = <?php echo json_encode($bookingslink); ?>;
							if (bookingLink != '') {
								if (tripData.label == "waiting list") {
									window.open(<?php echo json_encode($waitinglistactiveurl); ?>, "_blank");
								} else {
									window.open(bookingLink + '?trip=' + tripData.id, "_blank");
								}
							}
						}
					});
				} catch (e) {
					console.log('Something went wrong with the calendar')
				}
			});
		</script>
<?php
		return $html;
	}
}
