import React from "react";
import {InspectorControls, PanelColorSettings} from "@wordpress/block-editor";
import {ColorPalette, ColorPicker, PanelBody, PanelRow, SelectControl, ToggleControl} from "@wordpress/components";
import { __ } from '@wordpress/i18n'; // Add this import

export class BlockSettings extends React.Component {
	render(){
		const {attributes, setAttributes} = this.props;
		const { showTitle, showBook, showMeta, showDescription, showButton } = attributes;

		const onChangeShowTitle = (newValue) => {
			setAttributes({ showTitle: newValue });
		};

		const onChangeShowBook = (newValue) => {
			setAttributes({ showBook: newValue });
		};

		const onChangeShowMeta = (newValue) => {
			setAttributes({ showMeta: newValue });
		};

		const onChangeShowDescription = (newValue) => {
			setAttributes({ showDescription: newValue });
		};

		const onChangeShowButton = (newValue) => {
			setAttributes({showButton: newValue});
		};
		return (
			<InspectorControls>
				<PanelColorSettings
					title="Colors"
					colorSettings={[
						{
							label: "Card Color",
							value: attributes.cardColor,
							onChange: cardColor => setAttributes({cardColor})
						},
						{
							label: "Heading Color",
							value: attributes.headingColor,
							onChange: headingColor => setAttributes({headingColor})
						},
						{
							label: "Text Color",
							value: attributes.textColor,
							onChange: textColor => setAttributes({textColor})
						},
						{
							label: "Link Color",
							value: attributes.linkColor,
							onChange: linkColor => setAttributes({linkColor})
						}
					]}
				/>
				<PanelBody title={__('Show/Hide Fields', 'text-domain')}>
					<ToggleControl
						label={__('Show Title', 'text-domain')}
						checked={showTitle}
						onChange={onChangeShowTitle}
					/>
					<ToggleControl
						label={__('Show Book', 'text-domain')}
						checked={showBook}
						onChange={onChangeShowBook}
					/>
					<ToggleControl
						label={__('Show Meta', 'text-domain')}
						checked={showMeta}
						onChange={onChangeShowMeta}
					/>
					<ToggleControl
						label={__('Show Description', 'text-domain')}
						checked={showDescription}
						onChange={onChangeShowDescription}
					/>
					<ToggleControl
						label={__('Show Button', 'text-domain')}
						checked={showButton}
						onChange={onChangeShowButton}
					/>
				</PanelBody>



			</InspectorControls>
		)
	}
}
