( function( api ) {

	// Extends our custom "llorix-one-lite-frontpage-sections" section.
	api.sectionConstructor['llorix-one-lite-frontpage-sections'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	api.sectionConstructor['llorix-one-lite-frontpage-instrucctions'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );


} )( wp.customize );
