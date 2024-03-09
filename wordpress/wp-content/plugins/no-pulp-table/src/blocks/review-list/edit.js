/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import {BlockSettings} from "./BlockSettings";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {

	return (
		<div {...useBlockProps()}>
			<BlockSettings attributes={attributes} setAttributes={setAttributes} />
			<div className="review-card" style={{ backgroundColor: attributes.cardColor }}>
						{attributes.showTitle && (
							<h2 style={{ color: attributes.headingColor }}>Review Name</h2>
						)}
						{attributes.showBook && (
							<p style={{ color: attributes.textColor }}>
								<strong>Movie Title</strong>
							</p>
						)}

						{attributes.showMeta && (
							<div className="meta" style={{ color: attributes.textColor }}>
								<p>
									User Name<strong> ★★★★ </strong>
								</p>
								<p>Location</p>

							</div>
						)}
				<p>{attributes.showDescription && "Description here"}</p>

						{attributes.showButton && (
							<div className="review-button">
								<a style={{ color: attributes.linkColor }} href="#">
									Read More
								</a>
							</div>
						)}


			</div>
		</div>
	);
}
