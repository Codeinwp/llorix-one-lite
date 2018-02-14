/**
 * Customizer upsells control
 *
 * @package llorix-one-lite
 */
( function( api ) {

	api.sectionConstructor['llorix-one-lite-frontpage-instructions'] = api.Section.extend(
		 {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
					return true;
		}
	}
		);

	// Extends our custom "llorix-one-lite-theme-info" section.
	api.sectionConstructor['llorix-one-lite-theme-info'] = api.Section.extend(
		 {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
					return true;
		}
	}
		);

	// Extends our custom "llorix-one-lite-theme-info-sectionsections" section.
	api.sectionConstructor['llorix-one-lite-theme-info-section'] = api.Section.extend(
		 {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
					return true;
		}
	}
		);

} )( wp.customize );
