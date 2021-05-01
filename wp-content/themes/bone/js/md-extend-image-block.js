"use strict";

const { assign } = lodash;
const { createHigherOrderComponent } = wp.compose;
const { Fragment } = wp.element;
const { InspectorAdvancedControls } = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;
const { addFilter } = wp.hooks;
const { __ } = wp.i18n;

// Enable zoom control on the following blocks
const enableZoomControlOnBlocks = ["core/image"];

/**
 * Add zoom control attribute to block.
 *
 * @param {object} settings Current block settings.
 * @param {string} name Name of block.
 *
 * @returns {object} Modified block settings.
 */
const addZoomControlAttribute = ( settings, name ) => {
	// Do nothing if it's another block than our defined ones.
	if ( !enableZoomControlOnBlocks.includes( name ) ) {
		return settings;
	}

	// Use Lodash's assign to gracefully handle if attributes are undefined
	settings.attributes = assign( settings.attributes, {
		mdZoom: {
			type: 'boolean',
			default: false,
		}
	} );
	return settings;
};

addFilter(
	"blocks.registerBlockType",
	"md-bone-extend-image-block/attribute/mdzoom",
	addZoomControlAttribute
);

/**
 * Create HOC to add zoom control to inspector controls of block.
 */
const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		// Do nothing if it's another block than our defined ones.
		if (!enableZoomControlOnBlocks.includes(props.name)) {
			return /*#__PURE__*/ React.createElement(BlockEdit, props);
		}

		const { attributes, setAttributes, isSelected } = props;
		const { mdZoom } = props.attributes;

		// add js-imageZoom class to block
		// if ( zoom ) {
		// 	if (props.attributes.hasOwnProperty('className')) {
		// 		if (props.attributes.className.indexOf('js-imageZoom') === -1) {
		// 			props.attributes.className += ' js-imageZoom';
		// 		}
		// 	}
		// } else {
		// 	if (props.attributes.hasOwnProperty('className')) {
		// 		if (props.attributes.className.indexOf('js-imageZoom') !== -1) {
		// 			props.attributes.className = props.attributes.className.replace('js-imageZoom', '');
		// 			props.attributes.className = props.attributes.className.trim();
		// 		}
		// 	}
		// }

		return /*#__PURE__*/ React.createElement(
			Fragment,
			null,
			/*#__PURE__*/ React.createElement(BlockEdit, props),
			isSelected &&
			/*#__PURE__*/ React.createElement(
				InspectorAdvancedControls,
				null,
				/*#__PURE__*/ React.createElement(ToggleControl, {
					label: __( 'Enable zoom on click' ),
					value: mdZoom,
					checked: !! mdZoom,
					onChange: () => setAttributes( {  mdZoom: ! mdZoom } ),
				})
			)
		);
	};
}, "withAdvancedControls");
addFilter(
	"editor.BlockEdit",
	"md-bone-extend-image-block/with-zoom-control",
	withAdvancedControls
);

/**
 * Add margin style attribute to save element of block.
 *
 * @param {object} saveElementProps Props of save element.
 * @param {Object} blockType Block type information.
 * @param {Object} attributes Attributes of block.
 *
 * @returns {object} Modified props of save element.
 */

// const addZoomProps = (saveElementProps, blockType, attributes) => {
// 	// Do nothing if it's another block than our defined ones.
// 	if (!enableZoomControlOnBlocks.includes(blockType.name)) {
// 		return saveElementProps;
// 	}

// 	// add js-imageZoom class to block
// 	if ( attributes.zoom ) {
// 		if (saveElementProps.className.indexOf('js-imageZoom') === -1) {
// 			saveElementProps.className += ' js-imageZoom';
// 		}
// 	} else {
// 		// console.log(saveElementProps);
// 		if (saveElementProps.className.indexOf('js-imageZoom') !== -1) {
// 			saveElementProps.className = saveElementProps.className.replace('js-imageZoom', '');
// 		}
// 	}

// 	return saveElementProps;
// };

// addFilter(
// 	"blocks.getSaveContent.extraProps",
// 	"md-bone-extend-image-block/get-save-content/extra-props",
// 	addZoomProps
// );