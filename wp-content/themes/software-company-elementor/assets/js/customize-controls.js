( function( api ) {

	// Extends our custom "software-company-elementor" section.
	api.sectionConstructor['software-company-elementor'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );