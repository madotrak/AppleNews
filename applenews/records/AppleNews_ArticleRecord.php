<?php
namespace Craft;

/**
 * Class AppleNews_ArticleRecord
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2014, Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license Craft License Agreement
 * @see       http://craftcms.com
 * @package   craft.app.records
 * @since     1.0
 */
class AppleNews_ArticleRecord extends BaseRecord
{
	// Public Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::getTableName()
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return 'applenews_articles';
	}

	/**
	 * @inheritDoc BaseRecord::defineRelations()
	 *
	 * @return array
	 */
	public function defineRelations()
	{
		return [
			'entry' => [static::BELONGS_TO, 'EntryRecord', 'onDelete' => static::CASCADE],
		];
	}

	/**
	 * @inheritDoc BaseRecord::defineIndexes()
	 *
	 * @return array
	 */
	public function defineIndexes()
	{
		return [
			['columns' => ['entryId', 'channelId'], 'unique' => true],
		];
	}

	// Protected Methods
	// =========================================================================

	/**
	 * @inheritDoc BaseRecord::defineAttributes()
	 *
	 * @return array
	 */
	protected function defineAttributes()
	{
		return [
			'channelId'        => [AttributeType::String, 'required' => true, 'length' => 36],
			'articleId'        => [AttributeType::String, 'required' => true, 'length' => 36],
			'revisionId'       => [AttributeType::String, 'required' => true, 'length' => 24],
			'isSponsored'      => [AttributeType::Bool],
			'isPreview'        => [AttributeType::Bool],
			'state'            => [AttributeType::String],
			'shareUrl'         => [AttributeType::Url],
			'response'         => [AttributeType::Mixed],
		];
	}
}
